function checkForm(form) // Submit button clicked
{
  //
  // check form input values
  //
  var c = confirm("Do you really want to submit the form?");
  if(c == true){
    form.submit.disabled = true;
    form.submit.innerHTML = "Please wait...";
    return true;
  }else {
    return false;
  }
}
