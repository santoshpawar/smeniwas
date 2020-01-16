<?php

namespace App\Models\Loan\LiquidityModel;

use App\Models\Common\ConfigurableParameter;
use App\Models\Common\ConfIndustryTypeSectorOutlookMapping;
use App\Models\Common\OperandComparison;
use App\Models\Loan\FinancialData\ProfitLoss;
use App\Models\Loan\LoanAgainstShare;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Log;

class LiquidityModelDimension extends Model {

    use OperandComparison;

    public $table = "liquidity_model_dimensions";

    public $selected_rating_details_id;
    public $selected_measure_id;

    protected $fillable = [
    'category_id',
    'parent_dimension_id',
    'ratio_id',
    'dimension_type',
    'label',
    'description',
    'weight',
    'is_applicable',
    'is_trend',
    'model',
    'attribute',
    'status',
    ];

    public function category() {
        return $this->belongsTo('App\Models\Loan\LiquidityModel\LiquidityModelCategory', 'category_id', 'id')->where('status', '=', '1');
    }

    public function parentDimension() {
        return $this->belongsTo('App\Models\Loan\LiquidityModel\LiquidityModelDimension', 'parent_dimension_id', 'id')->where('status', '=', '1');
    }

    public function measures() {
        return $this->hasMany('App\Models\Loan\LiquidityModel\LiquidityModelMeasure', 'dimension_id', 'id')->where('status', '=', '1');
    }

    public function isParent() {
        $isParent = false;
        if ($this->dimension_type == 1) {
            $isParent = true;
        }
        return $isParent;
    }

    private static function fetchLiquidityModelDimension($keyName, $addEmptyFirstElement = true) {
        $cacheTimeout = Config::get('constants.MD_CACHE_TIMEOUT');
        $dimensionData = null;
        Cache::forget($keyName);

        if (Cache::has($keyName)) {
            $dimensionData = Cache::get($keyName);
        } else {
            $dimensionData = LiquidityModelDimension::where('label', "=", $keyName)->lists('label', 'weight')->all();
            if ($addEmptyFirstElement) {
                $dimensionData = [NULL => ''] + $dimensionData;
            }
            Cache::put($keyName, $dimensionData, $cacheTimeout);
        }
        return $dimensionData;
    }

    public function hasRatio() {
        return isset($this->ratio_id);
    }

    public function hasTrend() {
        return isset($this->is_trend) && $this->is_trend == true && isset($this->model) && isset($this->attribute);
    }

    public function calculateTrend($loan) {
        if (!$this->hasTrend()) {
            return;
        }

        $modelList = null;
        if (strcmp($this->model, Config::get('constants.CONST_PL_TABLE')) == 0) {
            $modelList = ProfitLoss::where('loan_id', '=', $loan->id)->orderBy('period', 'DESC')->get();
        } else if (strcmp($this->model, Config::get('constants.CONST_BS_TABLE')) == 0) {
            $modelList = BalanceSheet::where('loan_id', '=', $loan->id)->orderBy('period', 'DESC')->get();
        }

        if (isset($modelList)) {
            $y3 = null;
            $y2 = null;
            $y1 = null;
            $avgGrowth = null;

            foreach ($modelList as $model) {
                if (!$model->offsetExists($this->attribute)) {
                    Log::error('Liquidity Model autocalculation error! Cannot find attribute ' . $this->attribute . " for dimension " . $this->id . " - " . $this->label);
                }
                if ($y3 == null) {
                    $y3 = $model->getAttribute($this->attribute);
                } else if ($y2 == null) {
                    $y2 = $model->getAttribute($this->attribute);
                } else {
                    $y1 = $model->getAttribute($this->attribute);

                    $percentageChange1 = (($y3 - $y2) / $y2);
                    $percentageChange2 = (($y2 - $y1) / $y1);

                    $avgGrowth = (($percentageChange1 + $percentageChange2) / 2) * 100;
                    $this->calculateTrendMeasure($avgGrowth);
                }
            }
        }
    }

    protected function calculateTrendMeasure($avgGrowth) {
        $trend = null;
        $measuresList = $this->measures;
        $trendPositiveTolerance = null;
        $trendNegativeTolerance = null;

        if (strcmp($this->attribute, "net_revenue") == 0) {
            $trendPositiveTolerance = ConfigurableParameter::getParamValueOrDefault(Config::get('constants.CONST_LIQUIDITY_MODEL_TYPE_CREDIT'), 'Revenue Trend - Positive Tolerance', 6);
            $trendNegativeTolerance = ConfigurableParameter::getParamValueOrDefault(Config::get('constants.CONST_LIQUIDITY_MODEL_TYPE_CREDIT'), 'Revenue Trend - Negative Tolerance', 0);
        } else {
            //EBITDA
            $trendPositiveTolerance = ConfigurableParameter::getParamValueOrDefault(Config::get('constants.CONST_LIQUIDITY_MODEL_TYPE_CREDIT'), 'EBITDA Trend - Positive Tolerance', 6);
            $trendNegativeTolerance = ConfigurableParameter::getParamValueOrDefault(Config::get('constants.CONST_LIQUIDITY_MODEL_TYPE_CREDIT'), 'EBITDA Trend - Negative Tolerance', 0);
        }

        if ($avgGrowth > $trendPositiveTolerance) {
            $trend = "+ve trend";
        } else if ($avgGrowth >= $trendNegativeTolerance && $avgGrowth <= $trendPositiveTolerance) {
            $trend = "No trend";
        } else if ($avgGrowth < $trendNegativeTolerance) {
            $trend = "-ve trend";
        }

        if (isset($trend) && isset($measuresList)) {
            $foundMeasure = $measuresList->filter(function ($item) use (&$trend) {
                return strcmp($item->label, $trend) == 0;
            })->first();

            if (isset($foundMeasure)) {
                $this->selected_measure_id = $foundMeasure->id;
            }
        }
    }

    public function calculateDefault($loan) {

        if (!isset($this->model) && !isset($this->attribute) && !isset($loan)) {
            return;
        }

        $model = null;
        if (strcmp($this->model, Config::get('constants.CONST_PROMOTER_DETAILS_TABLE')) == 0) {
            $model = $loan->getPromoterDetails()->get()->first();
        } elseif (strcmp($this->model, Config::get('constants.CONST_LOANS_TABLE')) == 0) {
            $model = $loan;
        } elseif (strcmp($this->model, Config::get('constants.CONST_BUSINESS_DETAILS_TABLE')) == 0) {
            $model = $loan->getBusinessOperationalDetails()->get()->first();
        } elseif (strcmp($this->model, Config::get('constants.CONST_LOANS_SALESAREA_TABLE')) == 0) {
            $model = $loan->getSalesAreaDetails()->get()->first();
        }

        if (isset($model) && $model->offsetExists($this->attribute)) {
            $attributeValue = $model->getAttribute($this->attribute);
            $this->autoCalculateMeasureValue($attributeValue);
        } else if (strcmp($this->label, 'Project pipeline') == 0) {
            $loanBusinessType = $loan->com_business_type;
            if (strcmp($loanBusinessType, "Manufacturing") == 0 || strcmp($loanBusinessType, "Trading") == 0) {
                $this->is_applicable = 0;
            }
        } else if (strcmp($this->label, 'Presence of professional at key positions (CFO, COO etc.)') == 0) {
            $busOpDts = $loan->getBusinessOperationalDetails()->get()->first();
            $noMeasure = $this->getMeasureByLabel("No");
            $diversifiedMeasureId = isset($noMeasure) ? $noMeasure->id : null;
            if (isset($busOpDts)) {
                if (isset($busOpDts->fin_profession_1) || isset($busOpDts->fin_profession_2) || isset($busOpDts->fin_profession_3) || isset($busOpDts->fin_profession_4) || isset($busOpDts->fin_profession_5)) {
                    $yesMeasure = $this->getMeasureByLabel("Yes");
                    $diversifiedMeasureId = isset($yesMeasure) ? $yesMeasure->id : null;
                }
            }
            if (isset($diversifiedMeasureId)) {
                $this->selected_measure_id = $diversifiedMeasureId;
            }
        } else if (strcmp($this->label, 'Sector Outlook') == 0 && isset($loan->com_industry_segment)) {
            $mappedMeasureId = ConfIndustryTypeSectorOutlookMapping::getMappedMeasureId($loan->com_industry_segment);
            if (isset($mappedMeasureId)) {
                $this->selected_measure_id = $mappedMeasureId;
            }
        }

        if (strcmp($this->label, 'Market Cap') == 0) {
            $liquidityLas = LoanAgainstShare::where('loan_id', '=', $loan->id)->first();

            if ($liquidityLas->marketCapitalisation >= 250 && $liquidityLas->marketCapitalisation <= 500) {
                $this->selected_measure_id = '66';
            } elseif ($liquidityLas->marketCapitalisation >= 500 && $liquidityLas->marketCapitalisation <= 1000) {
                $this->selected_measure_id = '65';
            } elseif ($liquidityLas->marketCapitalisation >= 1000) {
                $this->selected_measure_id = '64';
            }}

            if (strcmp($this->label, '% shares pledged') == 0) {
                $liquidityLas = LoanAgainstShare::where('loan_id', '=', $loan->id)->first();

                if ($liquidityLas->currentQuarter < 30) {
                    $this->selected_measure_id = '53';
                } elseif ($liquidityLas->currentQuarter > 30 && $liquidityLas->currentQuarter < 51) {
                    $this->selected_measure_id = '51';
                } elseif ($liquidityLas->currentQuarter > 50 && $liquidityLas->currentQuarter < 75) {
                    $this->selected_measure_id = '52';
                } else {
                    $this->selected_measure_id = '54';
                }}

                if (strcmp($this->label, 'Share pledge trend (Q - on- Q)') == 0) {
                    $liquidityLas = LoanAgainstShare::where('loan_id', '=', $loan->id)->first();

                    if ($liquidityLas->currentQuarter > $liquidityLas->previousQuarter) {
                        $this->selected_measure_id = '47';
                    } elseif ($liquidityLas->currentQuarter < $liquidityLas->previousQuarter) {
                        $this->selected_measure_id = '49';
                    } else {
                      $this->selected_measure_id = '48';
                  }
              }

        
          }

          public function autoCalculateMeasureValue($value) {

            if (isset($this->measures)) {
                $measuresList = $this->measures;
                $measureFound = false;
                $foundMeasureId = null;
                foreach ($measuresList as $measure) {
                    if (isset($measure) && isset($measure->operand)) {
                        if (strcmp($measure->operand, "between") === 0) {
                            $beginRange = $measure->begin_range;
                            $endRange = $measure->end_range;
                            if ($beginRange <= $value && $value <= $endRange) {
                                $measureFound = true;
                                $foundMeasureId = $measure->id;
                                break;
                            }
                        } else {
                            if ($this->checkAssignmentOperations($measure->operand, $value, $measure->single_value)) {
                                $measureFound = true;
                                $foundMeasureId = $measure->id;
                                break;
                            }
                        }
                    }
                }

                if ($measureFound && isset($foundMeasureId)) {
                    $this->selected_measure_id = $foundMeasureId;
                }
            }
        }

        protected function getMeasureByLabel($measureLabel) {
            return $this->measures->filter(function ($measure) use (&$measureLabel) {
                if (strcmp($measure->label, $measureLabel) == 0) {
                    return true;
                }
            })->first();
        }

    /**
     * @param $businessOpsDetail
     * @param $sales
     * @return mixed
     */
    private function calculateSalesAmount($businessOpsDetail, $isCustomer) {
        $sales = 0;
        if ($isCustomer) {
            if ((isset($businessOpsDetail->top3_annsales_1) && is_numeric($businessOpsDetail->top3_annsales_1) && $businessOpsDetail->top3_annsales_1 > 0)
                || (isset($businessOpsDetail->top3_annsales_2) && is_numeric($businessOpsDetail->top3_annsales_2) && $businessOpsDetail->top3_annsales_2 > 0)
                || isset($businessOpsDetail->top3_annsales_3) && is_numeric($businessOpsDetail->top3_annsales_3) && $businessOpsDetail->top3_annsales_3 > 0
                ) {
                if (isset($businessOpsDetail->top3_annsales_1) && is_numeric($businessOpsDetail->top3_annsales_1) && $businessOpsDetail->top3_annsales_1 > 0) {
                    $sales += $businessOpsDetail->top3_annsales_1;
                }

                if (isset($businessOpsDetail->top3_annsales_2) && is_numeric($businessOpsDetail->top3_annsales_2) && $businessOpsDetail->top3_annsales_2 > 0) {
                    $sales += $businessOpsDetail->top3_annsales_2;
                }

                if (isset($businessOpsDetail->top3_annsales_3) && is_numeric($businessOpsDetail->top3_annsales_3) && $businessOpsDetail->top3_annsales_3 > 0) {
                    $sales += $businessOpsDetail->top3_annsales_3;
                    return $sales;
                }
            } else {
                if (isset($businessOpsDetail->vendor_saleamount_1) && is_numeric($businessOpsDetail->vendor_saleamount_1) && $businessOpsDetail->vendor_saleamount_1 > 0) {
                    $sales += $businessOpsDetail->vendor_saleamount_1;
                }

                if (isset($businessOpsDetail->vendor_saleamount_2) && is_numeric($businessOpsDetail->vendor_saleamount_2) && $businessOpsDetail->vendor_saleamount_2 > 0) {
                    $sales += $businessOpsDetail->vendor_saleamount_2;
                }

                if (isset($businessOpsDetail->vendor_saleamount_3) && is_numeric($businessOpsDetail->vendor_saleamount_3) && $businessOpsDetail->vendor_saleamount_3 > 0) {
                    $sales += $businessOpsDetail->vendor_saleamount_3;
                }

                if (isset($businessOpsDetail->vendor_saleamount_3) && is_numeric($businessOpsDetail->vendor_saleamount_3) && $businessOpsDetail->vendor_saleamount_3 > 0) {
                    $sales += $businessOpsDetail->vendor_saleamount_3;
                }

                if (isset($businessOpsDetail->vendor_saleamount_4) && is_numeric($businessOpsDetail->vendor_saleamount_4) && $businessOpsDetail->vendor_saleamount_4 > 0) {
                    $sales += $businessOpsDetail->vendor_saleamount_4;
                }

                if (isset($businessOpsDetail->vendor_saleamount_5) && is_numeric($businessOpsDetail->vendor_saleamount_5) && $businessOpsDetail->vendor_saleamount_5 > 0) {
                    $sales += $businessOpsDetail->vendor_saleamount_5;
                }

                if (isset($businessOpsDetail->vendor_saleamount_6) && is_numeric($businessOpsDetail->vendor_saleamount_6) && $businessOpsDetail->vendor_saleamount_6 > 0) {
                    $sales += $businessOpsDetail->vendor_saleamount_6;
                }

                //double the 6 monthly sales to arrive at the annual sales
                $sales = $sales * 2;
            }
        } else {
            if (isset($businessOpsDetail->supplier_amount_1) && is_numeric($businessOpsDetail->supplier_amount_1) && $businessOpsDetail->supplier_amount_1 > 0) {
                $sales += $businessOpsDetail->supplier_amount_1;
            }

            if (isset($businessOpsDetail->supplier_amount_2) && is_numeric($businessOpsDetail->supplier_amount_2) && $businessOpsDetail->supplier_amount_2 > 0) {
                $sales += $businessOpsDetail->supplier_amount_2;
            }

            if (isset($businessOpsDetail->supplier_amount_3) && is_numeric($businessOpsDetail->supplier_amount_31) && $businessOpsDetail->supplier_amount_3 > 0) {
                $sales += $businessOpsDetail->supplier_amount_3;
            }
        }

        return $sales;
    }
}