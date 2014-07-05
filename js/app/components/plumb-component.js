'use strict';

$(document).ready(function(){
  $.widget('lindneo.plumbComponent', $.lindneo.component, {
    
    options: {

    },

    _create: function(){

      var that = this;

      var letters = [];
      var i = this.options.component.data.word.length;
      while (i--) {
        letters.push(this.options.component.data.word[i]);
      }
      letters.reverse();
      console.log(letters);
      
      if(this.options.component.data.size == "") this.options.component.data.size = 100;
      console.log($(this.element).find("select .yanlis"));
      this._super();
      jsPlumb.bind("ready", function() {
        tesbihStilleriTanimla(parseInt(that.options.component.data.size));
        window.tesbihKonteyner=tesbihTaneleriOlustur(letters, that.element); 
        console.log(tesbihKonteyner);   
        tesbihTazele(tesbihKonteyner);
      });
       $( this.element ).resize(function() {
        jsPlumb.deleteEveryEndpoint();
        tesbihTazele(tesbihKonteyner);
      });
    },

    field: function(key, value){
      console.log(key);
      console.log(value);
      
      this._super();

      // set
      this.options.component[key] = value;

    }
    
  });
});

var tesbihStilleriTanimla = function (taneBoyutu){
  $("<style type='text/css'>#draggable{width: "+taneBoyutu+"px;height: 100px;padding: 0.5em; }</style>").appendTo("head");

  $("<style type='text/css'> .circleBase {border-radius: 50%;behavior: url(PIE.htc);margin:50px;float:left;}</style>").appendTo("head");

  $("<style type='text/css'>.type {width: "+parseInt(taneBoyutu*1.5)+"px;height:"+parseInt(taneBoyutu*1.5)+"px;background-image: url(../../../css/images/amber.png);background-size: "+parseInt(taneBoyutu*1.5)+"px "+parseInt(taneBoyutu*1.5)+"px;background-repeat: no-repeat;}</style>").appendTo("head");   
  $("<style type='text/css'>.taneKapsul{width: "+parseInt(taneBoyutu*1.5)+"px;height: "+parseInt(taneBoyutu*1.5)+"px;display:table-cell;vertical-align:middle;text-align:center;}</style>").appendTo("head");
  $("<style type='text/css'>div.taneKapsul select{font-size:"+parseInt(taneBoyutu*0.5)+"px;font-weight: bolder;background-color: transparent;      border:none;outline: none;-webkit-appearance: none;-moz-appearance: none;appearance: none;}</style>").appendTo("head");
  $("<style type='text/css'>div.taneKapsul select:focus{border:none;outline: none;}</style>").appendTo("head");
  $("<style type='text/css'>.yanlis{color:red;-webkit-text-stroke: "+parseInt(taneBoyutu*3.0/100)+"px black} .dogru{color:green;-webkit-text-stroke: "+parseInt(taneBoyutu*3.0/100)+"px black}</style>").appendTo("head");

}

var tesbihTaneleriOlustur = function (cevaplar, element){

  window.tesbihKonteyner=$("<div></div>").css({"width":"100%"});
  var alfabe=["?","A","B","C","Ç","D","E","F","G","Ğ","H","I","İ","J","K","L","M","N","O","Ö","P","R","S","Ş","T","U","Ü","V","Y","Z"];
  for (var i = 0; i < cevaplar.length; i++) {
    var tane=$("<div></div>")
        .addClass("circleBase type")
        .appendTo(tesbihKonteyner);

    var taneKapsul=$("<div></div>");
    taneKapsul.addClass("taneKapsul");
    taneKapsul.appendTo(tane);

    var secimKutusu= $("<select></select>");
    secimKutusu.addClass("yanlis");
    secimKutusu.attr('data-cevap', cevaplar[i]);
    secimKutusu.appendTo(taneKapsul);
    secimKutusu.on('change', '', function (e) {
          console.log("secim",$(this).val());
          console.log("cevap",$(this).data("cevap"))
          if($(this).val()==$(this).data("cevap")){
            $(this).removeClass("yanlis");
            $(this).addClass("dogru");
          }
          else
          {
            $(this).removeClass("dogru");
            $(this).addClass("yanlis");
          }
          console.log($(element).find(".dogru").length);
          if(cevaplar.length == $(element).find(".dogru").length) alert("Doğru bildin, tebrikler...");
    });

    for (var j = 0; j < alfabe.length; j++) {
       $("<option></option>", {value: alfabe[j], text: alfabe[j]}).appendTo(secimKutusu);
    };

  };

  tesbihKonteyner.appendTo(element);
  return tesbihKonteyner;

}

var tesbihTazele = function (tesbihKonteyner){
  var tesbihTaneleri=tesbihKonteyner.children();
  var tesbihTaneleriSayisi=tesbihTaneleri.length;
  var c1,c2;
  //jsPlumb.draggable($(".circleBase"));
  $.each(tesbihTaneleri,function(id,val){
      //jsPlumb.draggable($(val));
      /*(val).draggable({

           drag: function() {
              jsPlumb.deleteEveryEndpoint();
              tesbihTazele(tesbihKonteyner);
          }

      });*/
      if(id==0){
         c1 = jsPlumb.addEndpoint($(val),{anchor:"Right"});
      }
      else
      {
        //c2=jsPlumb.addEndpoint($(val),{anchor:"RightMiddle"});
         c2=jsPlumb.addEndpoint($(val),{anchor:"Left"});
        jsPlumb.connect({
             source:c1, 
             target:c2,
                     endpoint: ["Dot", {
                          radius: 2
                      }],
                      endpointStyle: {
                          fillStyle: "#19070B"
                      },
                      //setDragAllowedWhenFull: true,
                      paintStyle: {
                          strokeStyle: "#19070B",
                          lineWidth: 10
                      },
                      connector: ["Flowchart",{cornerRadius:20}]


           });
        if(id!=tesbihTaneleriSayisi-1)
        c1=jsPlumb.addEndpoint($(val),{anchor:"Right"});
      }


    }

  );
}





var createPlumbComponent = function ( event, ui ,oldcomponent) {

  var taneler;
  var boyut= "";

  if(typeof oldcomponent == 'undefined'){
    //console.log('dene');
    var top = (ui.offset.top-$(event.target).offset().top ) + 'px';
    var left = ( ui.offset.left-$(event.target).offset().left ) + 'px';
    var image_type = 'link';
  }
  else{
    top = oldcomponent.data.self.css.top;
    left = oldcomponent.data.self.css.left;
    image_type = oldcomponent.data.img.image_type;
  };
  
  var min_left = $("#current_page").offset().left;
  var min_top = $("#current_page").offset().top;
  var max_left = $("#current_page").width() + min_left;
  var max_top = $("#current_page").height() + min_top;
  var window_width = $( window ).width();
  var window_height = $( window ).height();

  if(max_top > window_height) max_top = window_height;
  if(max_left > window_width) max_top = window_width;

  top=(event.pageY-25);
  left=(event.pageX-150);

  if(left < min_left)
    left = min_left;
  else if(left+310 > max_left)
    left = max_left - 310;

  if(top < min_top)
    top = min_top;
  else if(top+600 > max_top)
    top = max_top - 600;

  top = top + "px";
  left = left + "px";

  var idPre = $.now();

  $('<div>').componentBuilder({

    top:top,
    left:left,
    title: j__("Sıralı Bulmaca"),
    btnTitle : j__("Ekle"), 
    beforeClose : function () {
      /* Warn about not saved work */
      /* Dont allow if not confirmed */
      return confirm(j__("Yaptığınız değişiklikler kaydedilmeyecektir. Kapatmak istediğinize emin misiniz?"));
    },
    onBtnClick: function(){

      if(typeof oldcomponent == 'undefined'){
        //console.log('dene');
        var top = (ui.offset.top-$(event.target).offset().top ) + 'px';
        var left = ( ui.offset.left-$(event.target).offset().left ) + 'px';
        
      }
      else{
        top = oldcomponent.data.self.css.top;
        left = oldcomponent.data.self.css.left;

      };
      
      var component = {
          'type' : 'plumb',
          'data': {
            "word":taneler,
            "size":boyut,
            'lock':'',
            'self': {
              'css': {
                'position':'absolute',
                'top': top ,
                'left':  left ,
                'width': "300px",
                'height': "300px",
                'background-color': 'transparent',
                'overflow': 'visible',
                'z-index': 'first'
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
        .appendTo(ui);

        var wordLabel = $('<label>')
          .text(j__("Bulmacanın içeriğindeki kelimeleri ardarda giriniz."))
          .appendTo(mainDiv);

        var wordDiv = $('<input type="text">')
          .change(function(){
            taneler = $(this).val().toUpperCase();
          })
          .appendTo(mainDiv);
        $("<br>").appendTo(mainDiv);

        var sizeLabel = $('<label>')
          .text(j__("Resim büyüklüğünü giriniz."))
          .appendTo(mainDiv);

        var sizeDiv = $('<input type="text">')
          .change(function(){
            boyut = $(this).val();
          })
          .appendTo(mainDiv); 
                    
    }

  }).appendTo('body');

};
