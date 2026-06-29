
$(function(){
	
		$('.sideBarNav>li>a').click(function(){
			$(this).parent().addClass('active').siblings().removeClass('active');
			$(this).siblings('.two_level').stop().slideToggle();
				$(this).parent().siblings().find('.two_level').stop().slideUp();
		});
		$('.two_level>li>a').click(function(){
			$(this).parent().addClass('active').siblings().removeClass('active');
			$(this).siblings('.three_level').stop().slideToggle();
				$(this).parent().siblings().find('.three_level').stop().slideUp();
		});
		
    $('.navIcon').click(function(){
      $('.sideBar').stop().animate({'right':'0'},500,function(){
        $('.goBack').css({
          'opacity':'0'
        })
      });
      $('.wrapper').addClass('zIndex');
      $('body').addClass('overflowY');
    });

    $('.sideBar .close').click(function(){
      $('.sideBar').stop().animate({'right':'-100%'},500,function(){
        $('.goBack').css({
          'opacity':'1'
        })
      });
      $('.wrapper').removeClass('zIndex');
			$('body').removeClass('overflowY');
    });

});

