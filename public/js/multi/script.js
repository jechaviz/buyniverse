function show_next(id,nextid,bar)
{
  var ele=document.getElementById(id).getElementsByTagName("input");
  var error=0;
  /*for(var i=0;i<ele.length;i++)
  {
    if(ele[i].type=="text" && ele[i].value=="")
  {
    error++;
  }
  }*/
	
  if(error==0)
  {
    document.getElementById("account_details").style.display="none";
    document.getElementById("user_details").style.display="none";
    document.getElementById("qualification").style.display="none";
    document.getElementById("team").style.display="none";
    $("#"+nextid).fadeIn();
    document.getElementById(bar).style.backgroundColor="#38610B";
    let current = document.querySelector('#'+bar);
    let nextSibling = current.previousElementSibling;
    nextSibling.style = "color: white;background-color: #005178;border: none;";
  }
  else
  {
    alert("Fill All The details");
  }
}

function show_prev(previd,bar)
{
  document.getElementById("account_details").style.display="none";
  document.getElementById("user_details").style.display="none";
  document.getElementById("qualification").style.display="none";
  document.getElementById("team").style.display="none";
  $("#"+previd).fadeIn();
  document.getElementById(bar).style.backgroundColor="#D8D8D8";
  let current = document.querySelector('#'+bar);
  let nextSibling = current.previousElementSibling;
  nextSibling.style = "";
}