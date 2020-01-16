
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script>
// This script is explained line by line in depth in the following video:
// http://www.developphp.com/view.php?tid=1389
function computeLoan(){
  var p = document.getElementById('p').value;
  var r = document.getElementById('r').value;
  var n = document.getElementById('n').value;
  var t = document.getElementById('t').value;

  // var interest = (amount * (r * .01)) / n;
  // var payment = ((amount / n) + interest).toFixed(2);
  // payment = payment.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  // document.getElementById('payment').innerHTML = "Monthly Payment = $"+payment;
  payment =  document.getElementById("payment");
  payment.innerHTML ="The interest rate of 1st month is " + Math.round(p*r*n/365)/100;

  

  fp = document.getElementById("fp");
  fp.innerHTML ="The principal rate is " + Math.round(p/t);
  due = document.getElementById("due");
  due.innerHTML = "The Due is " + ((Math.round(p/t))+(Math.round(p*r*n/365)/100));

  os = document.getElementById("os");
  os.innerHTML = "The Loan Outstanding is " + ((p)-(p/t));

  nod = document.getElementById("nod");
  nod.innerHTML = "The Number of Days " + (n);


}
</script>
</head>
<body>
<p>Loan Amount: $<input id="p" type="number" min="1" max="1000000" onchange="computeLoan()"></p>
<p>Interest Rate: <input id="r" type="number" min="0" max="100" value="1" step="1" onchange="computeLoan()">%</p>
<p>No of Days: <input id="n" type="number" min="1" max="30" value="1" step="1" onchange="computeLoan()"></p>
<p>Tenor: <input id="t" type="number" min="1" max="72" value="1" step="1" onchange="computeLoan()"></p>
<h1 id="payment"></h1>
<h2 id="fp"></h2>
<h3 id="due"></h3>
<h3 id="os"></h3>
<h3 id="nod"></h3>

</body>
</html>

