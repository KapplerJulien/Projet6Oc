var hideSeeImgVid = document.getElementById("display-hide-see-article-show");
var imgVidArticle = document.getElementById("display-images-videos-article-show");

var hideSeeComment = document.getElementById("display-hide-see-comment-article-show");
var commentArticle = document.getElementById("display-comment-article-show");

function togg(){
  console.log(imgVidArticle.style.display);
  if(imgVidArticle.style.display === "none" || imgVidArticle.style.display === ""){
    imgVidArticle.style.display = "flex";
  } else {
    imgVidArticle.style.display = "none";
  }
};

function hideSeeDisplayComment(){
  console.log(commentArticle.style.display);
  if(commentArticle.style.display === "none" || commentArticle.style.display === ""){
    commentArticle.style.display = "flex";
  } else {
    commentArticle.style.display = "none";
  }
};

function hideSeeEditImgVid(idEditimgVid){
  console.log(arguments[0])
  var idImgVid = arguments[0]
  if(idImgVid.style.display === "none" || idImgVid.style.display === ""){
    idImgVid.style.display = "flex";
  }
}

hideSeeImgVid.onclick = togg;
hideSeeComment.onclick = hideSeeDisplayComment;
