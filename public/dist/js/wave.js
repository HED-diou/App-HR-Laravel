 /* trigger when page is ready */
$(document).ready(function (){
	$(".pr-password").passwordRequirements({
		numCharacters: 6,
		useLowercase: false,
		useUppercase: true,
		useNumbers: false,
		useSpecial: true
	});
});

 /* Data Table Script */
$(document).ready(function() {
	$('#datable_2').DataTable();
} );

 $(document).ready(function() {

     var urls;
     var itemlist = $('.fixed-sidebar-left .side-nav > li');
     var docurl = document.location.href.replaceAll('/','');
     var childhref,slectedItem,slectedItemchild,tested="";
     for (var i = 0; i < itemlist.length; i++) {
         urls = $(itemlist[i]).children('ul').children('li').children('a');
         $(urls).removeClass('active-page');
         for (var j = 0; j < urls.length; j++) {
             childhref = $(urls[j]).attr("href").replaceAll('/','');
             if (docurl.includes(childhref)&&childhref.length >tested.length) {
                 tested=childhref;
                 slectedItem=$(urls[j]);
                 slectedItemchild=$(itemlist[i]);
             }
         }
     }
     $(itemlist).removeClass('active');
     $(slectedItem).addClass('active-page');
     $($(slectedItemchild).children('ul')).parent().find(">:first-child").addClass( "active" );
 } );
/* Datatimepicker Birthdate Script */
/*
 $( "#birthdate" ).datepicker({
	dateFormat: "yy-mm-dd",
	maxDate: "-18y",
   // minDate:"-100y",
	changeMonth: true,
	changeYear: true,
	firstDay: 1,
});

/* Datatimepicker Hiredate Script */
/*
$( "#hiredate" ).datepicker({
	dateFormat: "yy-mm-dd",
	changeMonth: true,
	changeYear: true,
	maxDate: "today",
	firstDay: 1,
});
*/

  var max = new Date().toISOString().split("T")[0];
 $('#hiredate').attr('max', max);
 $(function(){
     var dtToday = new Date();

     var month = dtToday.getMonth() + 1;// jan=0; feb=1 .......
     var day = dtToday.getDate();
     var year = dtToday.getFullYear() - 18;
     if(month < 10)
         month = '0' + month.toString();
     if(day < 10)
         day = '0' + day.toString();
     var minDate = year + '-' + month + '-' + day;
     var maxDate = year + '-' + month + '-' + day;
     $('#birthdate').attr('max', maxDate);
 });

/* Datatimepicker Start Date & End Date Script */
var ownership = document.getElementById("ownership");
var statuts = document.getElementById("statuts");



if (ownership  != null && statuts.value != null)
{
   if(ownership.value == 0)
{
   $( "#start_date" ).datepicker({
	dateFormat: "yy-mm-dd",
	default: "today",
	showButtonPanel:true,
	firstDay: 1,
	disabled: true,

   });

   $( "#end_date" ).datepicker({
	dateFormat: "yy-mm-dd",
	default: "today",
	showButtonPanel:true,
	firstDay: 1,
	disabled: true,
});
}
else if (statuts.value == 5)
{
$( "#start_date" ).datepicker({
	dateFormat: "yy-mm-dd",
	default: "today",
	showButtonPanel:true,
	firstDay: 1,
	disabled: true,
});

$( "#end_date" ).datepicker({
	dateFormat: "yy-mm-dd",
	default: "today",
	showButtonPanel:true,
	firstDay: 1,
	disabled: true,
});

}
else
{
	$( "#start_date" ).datepicker({
	dateFormat: "yy-mm-dd",
	default: "today",
	showButtonPanel:true,
	firstDay: 1,

});

$( "#end_date" ).datepicker({
	dateFormat: "yy-mm-dd",
	default: "today",
	showButtonPanel:true,
	firstDay: 1,
});
}
}

else
{
	$( "#start_date" ).datepicker({
	dateFormat: "yy-mm-dd",
	default: "today",
	showButtonPanel:true,
	firstDay: 1,

});

$( "#end_date" ).datepicker({
	dateFormat: "yy-mm-dd",
	default: "today",
	showButtonPanel:true,
	firstDay: 1,
});

}








/* Start Date & End Date Control */

        function GetDays(){
                var startdate = new Date(document.getElementById("start_date").value);
                var enddate = new Date(document.getElementById("end_date").value);
                return parseInt((enddate - startdate) / (24 * 3600 * 1000));
        }

        function cal()
	{

        if(document.getElementById("start_date")){

			var coming_at_evening = document.getElementById("coming_at_evening");
			var leaving_at_evening = document.getElementById("leaving_at_evening");
			var dayscount = GetDays();

			if(dayscount == 0)
			{
				document.getElementById("leaving_at_evening").disabled = true;
				document.getElementById("leaving_at_evening").checked = false;
			}
			else if ( ownership !=0 && dayscount != 0)
			{
				document.getElementById("leaving_at_evening").disabled = false;
			}

			if (leaving_at_evening.checked && coming_at_evening.checked)
			{
				document.getElementById("dayscount").value = GetDays() ;
			}

			else
			{
                				if(coming_at_evening.checked)
						{
							document.getElementById("dayscount").value = dayscount + 0.5 ;
						}

						else if (leaving_at_evening.checked)
						{
							document.getElementById("dayscount").value = dayscount - 0.5 ;
						}

						else
						{
							document.getElementById("dayscount").value = GetDays() ;
						}

			}
        }



    }

		function update()
		{
			Date.prototype.addDays = function(days) {
			var date = new Date(this.valueOf());
			date.setDate(date.getDate() + days);
			return date;
			}

			if(document.getElementById("start_date").value != "")
			{
				var date = new Date(document.getElementById("start_date").value);
				var days = parseInt(document.getElementById("dayscount").value);
				var newDate = date.addDays(days);
				var $datepicker = $('#end_date');
				$datepicker.datepicker();
				$datepicker.datepicker('setDate', newDate);
			}

			else
			{
				var date = new Date();
				var $datepicker = $('#start_date');
				$datepicker.datepicker();
				$datepicker.datepicker('setDate', date);

				var days = parseInt(document.getElementById("dayscount").value);
				var newDate = date.addDays(days);
				var $datepicker = $('#end_date');
				$datepicker.datepicker();
				$datepicker.datepicker('setDate', newDate);
			}


		}



/* Check Form Change Before Update */
var form_original_data = $("#myform").serialize();

function check_change() {

	var update_button = document.getElementById("update_button") ;

			if ($("#myform").serialize() == form_original_data && update_button != null) {

				document.getElementById("update_button").disabled = true
			}
            else
            {
				document.getElementById("update_button").disabled = false;
            }
		};

/* Enable/Disable User  */

		function enadisble(id)
	{
		var statut = document.getElementById(id);

		   if(statut.checked == true)
		{
			window.location.href='/admin/users/enable/' +id ;
		}
		else
		{
			window.location.href='/admin/users/disable/' +id ;
		}
	}


 function InvalidMssg(textbox) {

		    var tel="Phone number must contain 10 digits";
		    var mail="Please enter an email address which is valid!";
		    var number="This value must contain at least 0.5";
            var numbermax="This value is greater than 40";
     if (textbox.value === '') {
         textbox.setCustomValidity
         ('This field is necessary!');
     } else if(textbox.validity.typeMismatch){
         if(textbox.type==='email')
         {
             textbox.setCustomValidity
             (mail);
         }
     }else if(textbox.validity.rangeUnderflow){
         if(textbox.type==='number')
         {
             textbox.setCustomValidity
             (number);
         }
     }else if(textbox.validity.rangeOverflow){
         if(textbox.type==='number')
         {
             textbox.setCustomValidity
             (numbermax);
         }

     }else if(textbox.validity.tooShort){
         if(textbox.type==='tel')
         {
             textbox.setCustomValidity
             (tel);
         }

     }
     else {
        textbox.setCustomValidity('');

     }
     return true;
 }

