$(document).ready(function () {
	$('.owl-carousel').owlCarousel({
        items:1,
        loop:false,
        center:true,
        margin:10,
        URLhashListener:true,
        autoplayHoverPause:true,
	});
	$(".minimg-item").on("click",function(){
		$(".minimg-item").removeClass("active");
		$(this).addClass("active");
	})
$(".play").on("click", play);
   var cont = false; // id for audio element
   var music = false; // id for audio element
	var duration = false; // Duration of audio clip, calculated here for embedding purposes
	var pButton = false; // play button
	var playhead = false; // playhead
	var timeline = false; // timeline
	// Boolean value so that audio position is updated only when the playhead is released
	var onplayhead = false;
	// timeline width adjusted for playhead
	var timelineWidth = timeline.offsetWidth - playhead.offsetWidth;
	




// returns click as decimal (.77) of the total timelineWidth
function clickPercent(event) {
    return (event.clientX - getPosition(timeline)) / timelineWidth;
}
// mouseDown EventListener
function mouseDown() {
    onplayhead = true;
    window.addEventListener('mousemove', moveplayhead, true);
    music.removeEventListener('timeupdate', timeUpdate, false);
}

// mouseUp EventListener
// getting input from all mouse clicks
function mouseUp(event) {
    if (onplayhead == true) {
        moveplayhead(event);
        window.removeEventListener('mousemove', moveplayhead, true);
        // change current time
        music.currentTime = duration * clickPercent(event);
        music.addEventListener('timeupdate', timeUpdate, false);
    }
    onplayhead = false;
}
// mousemove EventListener
// Moves playhead as user drags
function moveplayhead(event) {
    var newMargLeft = event.clientX - getPosition(timeline);

    if (newMargLeft >= 0 && newMargLeft <= timelineWidth) {
        playhead.style.marginLeft = newMargLeft + "px";
    }
    if (newMargLeft < 0) {
        playhead.style.marginLeft = "0px";
    }
    if (newMargLeft > timelineWidth) {
        playhead.style.marginLeft = timelineWidth + "px";
    }
}

// timeUpdate
// Synchronizes playhead position with current point in audio
function timeUpdate() {
    var playPercent = timelineWidth * (music.currentTime / duration);
    playhead.style.marginLeft = playPercent + "px";
    if (music.currentTime == duration) {
        pButton.className = "";
        pButton.className = "play";
    }
}

//Play and Pause
function play() {
    // start music
   var id = $(this).parent().parent().attr("id");
   cont = document.querySelector('#'+id); // id for audio element
   music = cont.querySelector('.music'); // id for audio element
	duration = music.duration; // Duration of audio clip, calculated here for embedding purposes
	pButton = cont.querySelector('.pButton'); // play button
	playhead = cont.querySelector('.playhead'); // playhead
	timeline = cont.querySelector('.timeline'); // timeline
	// Boolean value so that audio position is updated only when the playhead is released
	onplayhead = false;
	// timeline width adjusted for playhead
	timelineWidth = timeline.offsetWidth - playhead.offsetWidth;

	// play button event listenter
	

	// timeupdate event listener
	music.addEventListener("timeupdate", timeUpdate, false);

	// makes timeline clickable
	timeline.addEventListener("click", function(event) {
	    moveplayhead(event);
	    music.currentTime = duration * clickPercent(event);
	}, false);



	// makes playhead draggable
	playhead.addEventListener('mousedown', mouseDown, false);
	window.addEventListener('mouseup', mouseUp, false);
	// Gets audio file duration
	music.addEventListener("canplaythrough", function() {
	    duration = music.duration;
	}, false);

    if (music.paused) {
        music.play();
        // remove play, add pause
        pButton.className = "";
        pButton.className = "pButton pause";
    } else { // pause music
        music.pause();
        // remove pause, add play
        pButton.className = "";
        pButton.className = "pButton play";
    }
}



// getPosition
// Returns elements left position relative to top-left of viewport
function getPosition(el) {
    return el.getBoundingClientRect().left;
}





/////////////////////////
	$(".value label").on("mouseover",function(){
		$(".value label").removeClass("active");
		var val = $(this).data("val");
		var arrayStar = document.querySelectorAll(".value label");
		for (var i = 0; i < val; i++) {
			arrayStar[i].setAttribute("class","active");
		}
	})
	$(".value label").on("mouseout",function(){
		$(".value label").removeClass("active");
		setStar();
	})
	function setStar(){
		var val = $(".value input[type=radio]:checked").val();
		var arrayStar = document.querySelectorAll(".value label");
		for (var i = 0; i < val; i++) {
			arrayStar[i].setAttribute("class","active");
		}
	}
	$(".value input[type=radio]").on("change",setStar);
	setStar();
	
})

