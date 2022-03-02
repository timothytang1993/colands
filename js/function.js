function joinBattle(battleField_id) {
  document.location.href = './joinbattle.php?battleField_id=' + battleField_id;
} //點擊參戰後，轉到相關戰役頁面

function checkResult(battleField_id) {
  document.location.href = './battleresult.php?battleField_id=' + battleField_id;
} //點擊參戰後，轉到相關戰役頁面

function previousResult(battleField_id) {
  battleField_id = battleField_id - 1;
  document.location.href = './battleresult.php?battleField_id=' + battleField_id;
} //點擊後跳到下一場戰況

function nextResult(battleField_id) {
  battleField_id = battleField_id + 1;
  document.location.href = './battleresult.php?battleField_id=' + battleField_id;
} //點擊後跳到下一場戰況

$(document).ready(function () {
  $('#dataTables-example').DataTable({
    responsive: true,
    "order": [[0, 'desc']]
  });
}); // 觸發表格排序

$(document).ready(function () {
  $('#dataTables-country').DataTable({
    responsive: true,
    "order": [[2, 'desc']]
  });
}); // 觸發國家表格排序

$(document).ready(function () {
  $('#dataTables-userList').DataTable({
    responsive: true,
    "order": [[0, 'asc']]
  });
}); // 觸發用戶名單排序

$(document).ready(function(){
  $("#send-btn").on("click", function(){
    $value = $("#dataBot").val();
    $value = $.trim($value);
    if($value != ""){
      $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
      $(".formBot").append($msg);
      $("#dataBot").val('');
      
      // start ajax code
      $.ajax({
          url: 'include/message.php',
          type: 'POST',
          data: 'text='+$value,
          success: function(result){
              $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
              $(".formBot").append($replay);
              // when chat goes down the scroll bar automatically comes to the bottom
              $(".formBot").scrollTop($(".formBot")[0].scrollHeight);
          }
      });
    }
  });
}); //mySql 交流機械人 點click

$(document).ready(function(){

  $("#input-bot").keyup(function(e){
      if(e.keyCode == 13){
      $value = $("#dataBot").val();
      $value = $.trim($value);
      if($value != ""){
      $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
      $(".formBot").append($msg);
      $("#dataBot").val('');
      
      // start ajax code
      $.ajax({
          url: 'include/message.php',
          type: 'POST',
          data: 'text='+$value,
          success: function(result){
              $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
              $(".formBot").append($replay);
              // when chat goes down the scroll bar automatically comes to the bottom
              $(".formBot").scrollTop($(".formBot")[0].scrollHeight);
              }
          });
        }
      }
    });
}); //mySql 交流機械人 keyup-enter
