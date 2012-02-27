
function pretty_datum(subject){
  var datum=new Date
  var hours=datum.getHours()
  var minutes=datum.getMinutes()
  var seconds=datum.getSeconds()

  if (minutes<=9){
    minutes="0"+minutes
  }

  if (seconds<=9){
    seconds="0"+seconds
  }

  var month = datum.getMonth();
  var monthname;
  if (month == 0) monthname = "January";
  if (month == 1) monthname = "February";
  if (month == 2) monthname = "March";
  if (month == 3) monthname = "April";
  if (month == 4) monthname = "May";
  if (month == 5) monthname = "June";
  if (month == 6) monthname = "July";
  if (month == 7) monthname = "August";
  if (month == 8) monthname = "September";
  if (month == 9) monthname = "October";
  if (month == 10) monthname = "November";
  if (month == 11) monthname = "December";

  var year = datum.getYear() 
  if (year >= 100)
  {
    if (year <= 200)
    {
      year = year + 1900;
    }
  }

  if (year <= 99)
  {
    if (year >= 0)
    {
      year = year + 2000;
    }
  }

  return monthname + " " + datum.getDate() + " " + year + " at " +hours+":"+minutes+":"+seconds;
}

