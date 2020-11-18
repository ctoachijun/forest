
<?
include "../../../../common.php";
include_once(G5_THEME_MOBILE_PATH.'/head.php');

$chk = checkCompanyInfo($mb_id,$mb_type);
if($chk=="N"){
  alert("거래에 필요한 기업 정보가 누락되어있습니다.","./view_pmypage.php");
}

$work_info = explode("|",getWorkInfo($idx));
$e_date = getDdate($idx);
$num = getNum($idx);

$jud = getEsti($mb_id,$idx);
$tjud = targetEsti($idx);

// echo "jud : $jud - tj : $tjud <br>";


if($jud || $tjud){
  // if($only=='N'){
    alert("해당 견적의뢰에 이미 견적을 제출하셨습니다",$return_url);
  // }
}



?>

<style>
.content{background-color:#F8F8F8;height:91vh;}
.wrap{margin-top:7.5vh;}
</style>

<div class="header">
  <h2>견적 의뢰서</h2>
</div>

<div class="wrap p_sub02 p_sub05">
  <form method="POST" action="../proc.php" name="ep_form" id="ep_form" onsubmit="return chk_form(<?=$num?>)" enctype="multipart/form-data">
    <input type="hidden" name="ep_idx" value="<?=$idx?>" />
    <input type="hidden" name="w_type" value="ins_esti" />
    <input type="hidden" name="num" value="<?=$num?>" />
    <input type="hidden" name="mb_id" value="<?=$mb_id?>" />
    <input type="hidden" name="mb_type" value="<?=$mb_type?>" />
    <input type="hidden" name="t_price" />
    <? getEpDetail($idx,$mb_id) ?>
    <? viewTreeInput($idx) ?>

    <div class="photo">
      <div class="file_head">
        <h4>조경수 사진 첨부</h4>
      </div>
        <? attachPic($idx) ?>
    </div>

    <div class="check">
      <div>
        <p class="bold">납품 현장</p>
        <p><?=$work_info[0]?></p>
      </div>
      <hr style="width:100%;margin:0 auto;margin-top:10px;margin-bottom:10px;">
      <div>
        <p class="bold">납품 날짜</p>
        <p><?=$work_info[1]?></p>
      </div>
      <hr style="width:100%;margin:0 auto;margin-top:10px;margin-bottom:10px;">
      <div>
        <p class="bold">요청 사항</p>
        <p><?=$work_info[2]?></p>
      </div>
      <hr style="width:100%;margin:0 auto;margin-top:10px;margin-bottom:10px;">
      <div>
        <p class="bold">기타 사항</p>
        <input type="text" name="etc" maxlength="255" placeholder="기타 사항 입력">
      </div>
    </div>

    <h4>납품금액</h4>
    <div class="payment">
      <div class="pay_head"><p>조경수</p> <input type="txt" name="sump" class="sum_price" value="0" disabled><p>원</p></div>
      <hr style="width:100%;margin:0 auto;margin-top:10px;margin-bottom:10px;">
      <div class="pay_head"><p>수수료</p> <input type="txt" name="tep" class="tep" value="0" disabled><p>원</p></div>
      <hr style="width:100%;margin:0 auto;margin-top:10px;margin-bottom:10px;">
      <div  class="blue">
        <div class="blue_p"><p>예상 운임비</p></div>
        <div class="blue_p"><input type="text" name="d_price" placeholder="입력" maxlength="10" onkeyup="onlyNum(this)" onchange="gettotal_price()"/><p>원</p></div>
      </div>
      <hr style="width:100%;margin:0 auto;margin-top:10px;margin-bottom:10px;">
      <div class="red"><p class="bold t_head">최종 결제 금액</p><input type="text" name="total_price" class="total_price" value="0" disabled><p>원</p></div>
      <hr style="width:100%;margin:0 auto;margin-top:10px;margin-bottom:10px;border-color:#ccc;">
    </div>

    <div class="date_dead">
      입찰 마감까지 <?=$e_date?>일 남음
    </div>

    <div class="click_box">
      <a class="back" onclick="call_back()">뒤로가기</a>
      <input type="submit" value="견적서 제출하기" class="enter" />
    </div>

  </form>
</div><!-- 전체 끝 -->


<script>

<? setPic($idx) ?>

$(function(){
    $("#date_wr_1").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", minDate: "+3d;", maxDate: "+365d;" });
    $("#date_wr_2").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", minDate: "+3d;", maxDate: "+365d;" });
});
$("input[name=d_price]").bind("change keypress input", function(event){
  let val = $("input[name='total[]']").val();
  val = val.replace(/[^0-9]/g,"");
  val = String(val);
  val = val.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

  $("input[name=d_price]").val(val);
});
</script>



<?include "./p_tail.php"?>
