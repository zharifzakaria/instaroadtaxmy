function formatIC(obj) {
  var numbers = obj.value.replace(/\D/g, ''),
      char = {6:'-',8:'-'};
  obj.value = '';
  for (var i = 0; i < numbers.length; i++) {
      obj.value += (char[i]||'') + numbers[i];
  }
}

function maxLengthCheck(object, maxdigit)
{
  if (object.value.length > maxdigit)
    object.value = object.value.slice(0, maxdigit)
}

function numberWithCommas(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}