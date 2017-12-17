$(document).ready(function () {
    $("button[name='order']").prop('disabled','true');

    $('.owl-carousel').owlCarousel({
        items: 1,
        loop: false,
        center: true,
        margin: 10,
        URLhashListener: true,
        autoplayHoverPause: true,
    });
    $(".minimg-item").on("click", function () {
        $(".minimg-item").removeClass("active");
        $(this).addClass("active");
    });
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
        cont = document.querySelector('#' + id); // id for audio element
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
        timeline.addEventListener("click", function (event) {
            moveplayhead(event);
            music.currentTime = duration * clickPercent(event);
        }, false);


        // makes playhead draggable
        playhead.addEventListener('mousedown', mouseDown, false);
        window.addEventListener('mouseup', mouseUp, false);
        // Gets audio file duration
        music.addEventListener("canplaythrough", function () {
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
    $(".value label").on("mouseover", function () {
        $(".value label").removeClass("active");
        var val = $(this).data("val");
        var arrayStar = document.querySelectorAll(".value label");
        for (var i = 0; i < val; i++) {
            arrayStar[i].setAttribute("class", "active");
        }
    });
    $(".value label").on("mouseout", function () {
        $(".value label").removeClass("active");
        setStar();
    });
    function setStar() {
        var val = $(".value input[type=radio]:checked").val();
        var arrayStar = document.querySelectorAll(".value label");
        for (var i = 0; i < val; i++) {
            arrayStar[i].setAttribute("class", "active");
        }
    }

    $(".value input[type=radio]").on("change", setStar);
    setStar();


    $('.drum__filter-submit.feed-sub').click(function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var text = $('textarea.text-feed').val();
        var rating = $('.feedbackForm label.active').length;
        console.log(id);
        console.log(text);
        console.log(rating);
        $.ajax("/api/submitWorkerComment", {
            type: "POST",
            data: "worker=" + id + '&message=' + text + '&rating=' + rating,
            async: false,
            complete: function (response) {
                response = JSON.parse(response.responseText);
                if (response['error'] !== undefined) {
                    alert(response['error']);
                    return;
                }
                alert(response['message']);
            }
        });
    });

});



//// получение цены онлайн и разрешение на заказ

    $("input[type='date']").click(function (e) {

        var orderDate= $("input[type='date']").val();
        var orderType;
        var orderLength;
        var orderCity;
        var orderWorker=$("#worker")[0].getAttribute("data-worker");

        if ($("#allnight").prop("checked")) orderType=1;
        if ($("#hours").prop("checked")) orderType=2;
        if (orderType==2)   orderLength=$("input[type='orderhours']").val();
            else orderLength=0;
        var elements=document.querySelectorAll("input[name='city_wedding']");
        for (var i = 0; i < elements.length; i++) {
       
         if ($(elements[i]).prop("checked")) {  
            orderCity=elements[i].getAttribute('data-city'); 
                   
            break; 
         
            }
         }
     });

    var orderComment=$("textarea[name='commentBron']").val();
        /*if (trigDate&&trigHours&&trigCity) {
        
        var categoryWorker=$("#worker")[0].getAttribute("data-category"); 

        $.ajax({
            url: "/api/priceCreate",
            type: "POST",
            data: {data},
            complete: function (data) {
                  //alert ("Заявка отправлена, ожидайте СМС оповещения") ;
              }
                });
          
        */
        //}
    

            


/// отправка заказа после разрешения 
$("button[name='order']").click(function (e) {
    e.preventDefault();
    var client=$("input[name='name']").val();
    var clientTel=$("input[name='tel']").val();
    //alert(client);
    data=[orderDate,orderType,orderLength,orderCity,orderComment,orderWorker];
    console.log(data);

     $.ajax({
            url: "/api/orderCreate",
            type: "POST",
            data: {data},
            complete: function (data) {
                  alert ("Заявка отправлена, ожидайте СМС оповещения") ;
              }
                });



});