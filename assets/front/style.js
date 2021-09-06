$(document).ready(function(){
        $(".header-gif").height($(window).height() - $('header').height());
        $('.imgView').click(function(e){
                $("#main-img").attr('src',$(this).find('.image').attr('src')) ; 
        console.log( $("#main-img").attr('src')  );
        
        });
       if($('.select').find(':selected').data('val') == 0){
                $("label[for='quantity']").hide();
                $('#quantity').hide();
                $('.quantity_available').hide();
                $('.available').val($(this).find(':selected').data('val'));
                $('.buybtn').hide();
                var soldbtn ='<div  class="btn btn-danger form-control soldbtn" style="height=100px">SOLD OUT!</div>'
                $('.select').parents('form').append(soldbtn); 
       }
        $('.select').change(function (e) { 
                e.preventDefault();
                if( $(this).find(':selected').data('val') > 0 ){
                        $("label[for='quantity']").show();
                        $('#quantity').show();
                        $('.quantity_available').show();
                        $('.buybtn').show();
                        if($('.soldbtn').length){
                          $('.soldbtn').hide();
                        }
                        $('.quantity_available').text('Avaliable : ' + $(this).find(':selected').data('val'));
                        $('.available').val($(this).find(':selected').data('val'));
                }else{
                        $("label[for='quantity']").hide();
                        $('#quantity').hide();
                        $('.quantity_available').hide();
                        $('.available').val($(this).find(':selected').data('val'));
                        $('.buybtn').hide();
                        if($('.soldbtn').length){
                                $('.soldbtn').show();
                        }else{
                                var soldbtn ='<div  class="btn btn-danger form-control soldbtn" style="height=100px">SOLD OUT!</div>'
                                $(this).parents('form').append(soldbtn);
                        }
                       
                        
                }
        });
         
});

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
        modal.onclick = function(){
                modal.style.display = "none";
        }
        span.onclick = function() {
                modal.style.display = "none";
        }
}
