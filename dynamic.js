var button = document.getElementsByTagName("button")[0];
var button_1 = document.getElementsByTagName("button")[1];
var button_2 = document.getElementsByTagName("button")[2];
var form = document.getElementsByTagName("form")[0];
var form_1 = document.getElementsByTagName("form")[1];
var form_2 = document.getElementsByTagName("form")[2];

button.onclick = function()
{
  form.style.display = "inline"; 						//Apparition du formulaire au clic du bouton
};

button_1.onclick = function()
{
  form_1.style.display = "inline";
};

button_2.onclick = function()
{
  form_2.style.display = "inline";
};