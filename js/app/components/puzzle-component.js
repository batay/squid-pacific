'use strict';

$(document).ready(function(){
  $.widget('lindneo.puzzleComponent', $.lindneo.component, {
    
    options: {

    },

    _create: function(){

      var that = this;
      console.log(this.options.component.data.difficulty);
      var imageElement ;
      var puzzleElement ;
      var id = "girl";

      var image = $('<img>')
        .attr('src',this.options.component.data.imageBinary)
        .attr('id',id)
        .addClass("puzzle")
        .attr('width',"100%")
        .attr('height',"100%")
        .appendTo(this.element)
        .load(function(){
          imageElement= image[0];
          puzzleElement = snapfit.add(
            imageElement,
            {
              callback: function() {
                
                alert("Tebrikler başarıyla tamamladınız.");
                  snapfit.remove(document.getElementById(id));
                
                }, 
              aborder:true, 
              aimage:false, 
              polygon:true, 
              space:10,
              level:that.options.component.data.difficulty,
              mixed:true,
              //bwide:6,
              simple:true,
              forcetui:true,
              nokeys:true
            });
          console.log($(".puzzle").css({"width":"100%","height":"100%"}));
          
        });

      

      //this._resize(function(){
        //console.log(this);
      //});

      this._super({resizableParams:{handles:"e, s, se"}});
    },

    field: function(key, value)
 {     console.log(key);
      console.log(value);
      
      this._super();

      // set
      this.options.component[key] = value;

    }
    
  });
});


var createPuzzleComponent = function ( event, ui, oldcomponent ) {  

  var difficulty = 1;
  var difficultyValue;
  var imageBinary;
  
  if(typeof oldcomponent == 'undefined'){
    var top = (ui.offset.top-$(event.target).offset().top ) + 'px';
    var left = ( ui.offset.left-$(event.target).offset().left ) + 'px';
    var width = 'auto';
    var height = 'auto';
  }
  else{
    top = oldcomponent.data.self.css.top;
    left = oldcomponent.data.self.css.left;
    var width = oldcomponent.data.width ;
    var height = oldcomponent.data.height;
  };
  
  var min_left = $("#current_page").offset().left;
  var min_top = $("#current_page").offset().top;
  var max_left = $("#current_page").width() + min_left;
  var max_top = $("#current_page").height() + min_top;
  var window_width = $( window ).width();
  var window_height = $( window ).height();

  if(max_top > window_height) max_top = window_height;
  if(max_left > window_width) max_top = window_width;
  
  var top=(event.pageY - 25);
  var left=(event.pageX-150);

  console.log(top);

  if(left < min_left)
    left = min_left;
  else if(left+200 > max_left)
    left = max_left - 200;

  if(top < min_top)
    top = min_top;
  else if(top+300 > max_top)
    top = max_top - 300;

  top = top + "px";
  left = left + "px";

  var idPre = $.now();

  $('<div>').componentBuilder({
    top:top,
    left:left,
    title: j__("Puzzle"),
    btnTitle : j__("Ekle"), 
    beforeClose : function () {
      /* Warn about not saved work */
      /* Dont allow if not confirmed */
      return confirm(j__("Yaptığınız değişiklikler kaydedilmeyecektir. Kapatmak istediğinize emin misiniz?"));
    },
    onBtnClick: function(){

      if(typeof oldcomponent != 'undefined'){
        
        top = oldcomponent.data.self.css.top;
        left = oldcomponent.data.self.css.left;
      }  

      var  component = {
        'type' : 'puzzle',
        'data': {
          'difficulty':  difficulty,
          'imageBinary':  imageBinary,
          'width': width,
          'height': height,
          'lock':'',
          'self': {
            'css': {
              'position':'absolute',
              'top': top ,
              'left':  left ,
              'width':'320px',
              'height':'320px',
              'background-color': 'transparent',
              'overflow': 'visible',
              'z-index': 'first',
              'opacity':'1'
            }
          }
        }
      };
      if(typeof oldcomponent !== 'undefined'){
        window.lindneo.tlingit.componentHasDeleted( oldcomponent, oldcomponent.id );
      };
      window.lindneo.tlingit.componentHasCreated( component );
    },
    onComplete:function (ui){
      var mainDiv = $('<div>')
        .css({"width":"100%","height":"100%"})
        .appendTo(ui);

        var tolaranceDiv = $('<div>')
          .appendTo(mainDiv);


          var difficultyLbl = $("<label>")
            .addClass("col-sm-4")
            .append(j__("Zorluk değeri")+":")
            .appendTo(tolaranceDiv);

          var difficultyValue = $('<span>')
            .addClass("col-sm-2")
            .addClass("integer")
            .addClass("bold")
            .text(difficulty);
            

          var difficultySlider = $('<div>')
            .addClass("col-sm-6")
            .slider({
              value: difficulty,
              min: 1,
              max: 6,
              step: 1,
              slide: function( event, ui ) {
                difficulty = ui.value;
                difficultyValue.text( difficulty );
              }
            }).appendTo(tolaranceDiv);

          difficultyValue.appendTo(tolaranceDiv);

        var tabDiv = $ ('<div>')
            .addClass("tabbable")
            .appendTo(mainDiv);

            var tabUl = $ ('<ul>')
              .addClass("nav nav-tabs")
              .appendTo (tabDiv);

              var tabGaleryDragLi = $('<li>')
                .addClass("active")
                .appendTo(tabUl);
                
                var tabGaleryDragA = $ ('<a>')
                  .attr('href','#'+idPre+'drag')
                  .attr('data-toggle','tab')
                  .text(j__("Resim Sürükle"))
                  .appendTo(tabGaleryDragLi);

              
              var tabGaleryUploadLi = $('<li>')
                .appendTo(tabUl);

                var tabGaleryUploadA = $ ('<a>')
                  .attr('href','#'+idPre+'upload')
                  .attr('data-toggle','tab')
                  .text(j__("Resim Yükle"))
                  .appendTo(tabGaleryUploadLi);

              $('<br>').appendTo(tabDiv);

            var imageDiv = $ ('<div>')
                .addClass("tab-content")
                .appendTo(tabDiv);

                var imageDragDiv = $ ('<div>')
                  .addClass("tab-pane fade")
                  .addClass("active in")
                  .attr('id',idPre+'drag')
                  .appendTo(imageDiv);

                  $('<br>').appendTo(imageDragDiv);

                  var imageDragContent = $ ('<div>')
                    .addClass("add-image-drag-area")
                    .on('dragenter', function (e) 
                    {
                        e.stopPropagation();
                        e.preventDefault();
                    })
                    .on('dragexit', function (e) 
                    {
                        e.stopPropagation();
                        e.preventDefault();
                    })
                    .on('dragover', function (e) 
                    {
                         e.stopPropagation();
                         e.preventDefault();
                    })
                    .on('drop', function (e) 
                    {
                     
                      e.stopPropagation();
                      e.preventDefault();

                      var reader = new FileReader();
                      var component = {};
                      
                      reader.onload = function (evt) {

                        var image = new Image();
                        image.src = evt.target.result;

                        image.onload = function() {
                         
                          
                          image_width = this.width;
                          image_height = this.height;
                          var size = window.lindneo.findBestSize({'w':image_width,'h':image_height});
                          image_width = size.w;
                          image_height = size.h;
                        
                        
                          imageBinary = evt.target.result;

                          newImageDiv.html("");
                          $("<img src='"+imageBinary+"' style='width:60px; height:60px;'>").appendTo(newImageDiv);
                     

                        }; 
                      };
                      //console.log(e.originalEvent.dataTransfer.files[0]);
                      reader.readAsDataURL( e.originalEvent.dataTransfer.files[0] );

                    })
                    .appendTo(imageDragDiv);


                var imageUploadDiv = $ ('<div>')
                  .addClass("tab-pane fade")
                  .attr('id',idPre+'upload')
                  .appendTo(imageDiv);

                  var imageUploadDiv = $ ('<input type="file">')
                    .attr("name","image_file")
                    .change(function(){
                      var file = this.files[0];
                      var name = file.name;
                      var size = file.size;
                      var type = file.type;
                      
                      var reader = new FileReader();
                      var component = {};
                      reader.readAsDataURL(file);
                      //console.log(reader);
                      reader.onload = function(_file) {
                        //console.log(_file);
                        var image = new Image();
                          image.src = _file.target.result;

                          image.onload = function() {
                          // access image size here 
                          
                          image_width = this.width;
                          image_height = this.height;
                          if($('#width').val() != '')
                            image_width = $('#width').val();
                          if($('#height').val() != '')
                            image_height = $('#height').val();
                          var size = window.lindneo.findBestSize({'w':image_width,'h':image_height});
                          image_width = size.w;
                          image_height = size.h;

                          
                          
                          imageBinary = _file.target.result;  
                          newImageDiv.html("");
                          $("<img src='"+imageBinary+"' style='width:60px; height:60px;'>").appendTo(newImageDiv);
                        }
                      }
                    })
                    .appendTo(imageUploadDiv);

        var newImageDiv = $('<div>')
          .addClass("newimage")
          .appendTo(mainDiv);

                

    }

  }).appendTo('body');

};