 var $search = $('[data-select-search]');
    var $select = '#'+$($search).data('selectSearch');
    
    $($search).on('keyup change', function(){
      var search_val = $(this).val().toLowerCase();
      
      if(search_val.length >= 2){
          $($select).children().each(function(){
            if(!$(this).text().toLowerCase().match(search_val)){
              $(this).hide();
            }else{
              $(this).show();
            }
          });
      }else{
        
        $($select).children().each(function(){
          $(this).show();
          $($select).attr('size', $($select).children().length)
        });
        
      }
    });

    $($search).focus(function(){
      $($select).attr('size', $($select).children().length)
      $($select).css('top', $(this).outerHeight());
      $($select).css('z-idnex', '3');
      $(this).css('color', 'inherit');
      
      function reset(){
        $($select).attr('size', 1)
        $($select).css('top', 0);
        $($select).css('z-idnex', '-1');
        $($search).val($('option:selected').text())
        $($search).css('color', 'transparent');
      }
      
      //close the list
      $($select).change(function(){
        reset();
      });
      
      $($search).blur(function(){
        setTimeout(function(){
          if(!$($select).is(":focus")){
            reset();
          }
        }, 50);
      });
      
    });