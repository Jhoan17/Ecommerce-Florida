// var created_at = null;

function pushLoad(created_at,count=false){


  $.ajax({
    async: true,
    url:$("#push-url").val(),
    type:"GET",
    data:"created_at="+created_at,
    success: function(answer){
      // console.log(answer);
      var json = eval("(" + answer + ")");
      
      created_at = json.created_at;
      created_att = json.created_att;
      notification_type = json.notification_type;
      notification_id = json.notification_id;

      if(created_at == null){
        
      }else{
        
        if(count == true){

          const count_notification = parseInt($("#input-count-notification").val())+1;
          $("#input-count-notification").val(count_notification);
          $(".count-notification").html(count_notification);

          if (notification_type == "order") {notification_type = "Orden"}else{notification_type="Sugerencia"}

          date_db = created_att.split(" ");

          moment.tz("America/Bogota");
          var date_ac = moment().format("Y-MM-DD");

          if (date_ac == date_db[0]) {
            $("#desc-notifications").append('<div class="dropdown-divider"></div><a href="http://ecommerce-florida.test/admin/notification-read/'+notification_id+'"  class="dropdown-item"><i class="fa fa-sort-amount-up mr-2"></i>Nueva '+notification_type+'</span><span class="float-right text-muted text-sm">Hoy, '+ date_db[1] +' '+date_db[2]+'</span></a>')
          }else if(moment().subtract(1, 'days').format("Y-MM-DD") == date_db[0]){
            $("#desc-notifications").append('<div class="dropdown-divider"></div><a href="http://ecommerce-florida.test/admin/notification-read/'+notification_id+'"  class="dropdown-item"><i class="fa fa-sort-amount-up mr-2"></i>Nueva '+notification_type+'</span><span class="float-right text-muted text-sm">Ayer, '+ date_db[1] +'</span></a>')
          }
          
          $('#notifiable-sound')[0].play();
          // console.log(created_at);
        }
      }

      setTimeout(pushLoad(created_at,true), 6000);

    },
    error:function(error){
      console.log(error);
    }
  });
}



$(document).ready(function () {

    pushLoad(null);

    $(".toast-time-hide").fadeOut(4000);


    $('.lowercase').keyup(function(){
      this.value = this.value.toLowerCase();
    });

    $('.uppercase').keyup(function(){
      this.value = this.value.toUpperCase();
    });

    var menu = $('ul.nav-sidebar').find('a.active').parents('li.has-treeview');
    menu.addClass('menu-open');
    menu.children('a').addClass('active');



});

