 /* when select file img it shows immediatly  */
 function loadFile (event,id) {
    console.log(id);
    var image = document.getElementById(id);
    image.src = URL.createObjectURL(event.target.files[0]);
}

/* pop up image when press on it */
function popImg(img_id){
    var modal = document.getElementById("myModal");
    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById(img_id);
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
      modal.style.display = "block";
      modalImg.src = img.src;
      captionText.innerHTML = img.alt;
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
}


$(document).ready(function(){
   var count = 0;
   $(".add-img").click(function(e){
        e.preventDefault();
        var op = 'output'+ count +'';
        var img = 'image'+ count++ +'';
        var add = '<div class="col-6 col-md-4">\n'+
        '<p><img class="img-fluid imgs"  id="'+ op +'" "src="#" /></p>\n' +
        '<p><input type="file"  accept="image/*" name="img[]"  id="'+ img + '" onchange = loadFile(event,"'+ op +'") style="display: none;"></p>\n'+
        '<p><label for="'+ img +'" style="cursor: pointer;">Upload Image</label></p>\n'+
        '</div>\n';
        $('.parent-img').append(add);
        // $(add).insertBefore('.add-img');
   });

  //  $('new-img').attr({ value: '' }); 
});
