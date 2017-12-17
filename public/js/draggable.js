window.addEventListener("load", dragdrop,false);
function dragdrop(e) {
  var listMedia = document.getElementById("video_options");
  if(listMedia){
    Sortable.create(listMedia, {
     animation: 150
    });
  }
  var listAudio = document.getElementById("audio_options");
  if(listAudio){
    Sortable.create(listAudio, {
     animation: 150
    });
  }

  $(".item.video").on("click",function(){
    $(".obert").css("display","block");
    $(".video_wrap").css("display","block");
    $(".video iframe").css("display","none");
    $(this).find(".obert").css("display","none");
    $(this).find(".video_wrap").css("display","none");
    $(this).find("iframe").css("display","block");
  })
}
