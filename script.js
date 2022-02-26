/*global $*/
$(function(){
    const images = ['images/1.jpg', 'images/2.jpg', 'images/3.jpg'];
    let count = 1;
    
    const change_image = () => {
     $('#effect1 img').animate({'opacity': 0}, 1000, function(){
        // alert('OK');
        $('#effect1 img').prop('src', images[count]);
        $('#effect1 img').animate({'opacity': 1}, 1000);
        
        count++;
        if(count === images.length){
            count = 0;
        }
    })};
    
    setInterval(change_image, 5000);
    
    $('#effect2 img').eq(1).css('margin-left', '-500px');
    $('#effect2 img').eq(2).css('margin-left', '-500px');
    
    // 何枚目の画像をスライドさせるかのカウンター
    let count_slider = 0;
    
    
    // 画像をスライドする関数
  const slider = () => {
    $.when(
        $('#effect2 img').eq(count_slider % 3).animate({'marginLeft': '500px'}, 2000),
        $('#effect2 img').eq((count_slider + 1) % 3).animate({'marginLeft': '0px'}, 2000)
        ).done(function(){
        $('#effect2 img').eq(count_slider % 3).css('margin-left', '-500px');
        count_slider++;
        });
        }
            // 画像のスライドアニメーション開始
    setInterval(slider, 5000);
    
})