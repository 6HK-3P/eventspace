$(document).ready(function () {
  var eventDates = [1, 11, 10, 17, 18, 19, 12, 22,25]; ///Тут надо принимать массив занятых дней
	 $('.datepicker-here').datepicker({
	  inline: true,
	  minDate: new Date(),
	  language: 'ru',
	  range: true,
	  onSelect: function(dateText) {
	    /*$.ajax({
	      url: "#",
	      data: dateText
	    }).done(function() {*/
	      console.log(dateText);
	   /* })*/
	  },
	  onRenderCell: function (date, cellType) {
	    var currentDate = date.getDate();
	      if (cellType == 'day' && eventDates.indexOf(currentDate) != -1) {
	        return {
	          html: '<span class="busy-day-datepic">' + currentDate + '</span>'
	        }
	      }
	  }
	})
	  
})
