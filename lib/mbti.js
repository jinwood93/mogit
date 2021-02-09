
let totalpoint = 0;

function value_check() {
    let total= 0;
    let Qnum=11;
    let kkk=1;
    
   
   
    for(let k=1; k<Qnum;k++){
        let check_count = document.getElementsByName(k).length;
        console.log(check_count);
        for (let i=0; i<check_count; i++) {
          if (document.getElementsByName(k)[i].checked == true) {
            total+=Number(document.getElementsByName(k)[i].value);
          }
        }
      }
      console.log(total);
    
   
    
      
       if(total>=10 && total<=20){
        //$("#main-button").click(function(){ 
            let tag = "<input type='button' id='result-button' "+'onclick='+'"'+"location.href="+"'mbti1.php' "+'"'+" value='결과!' />";
            
            $("#test").append(tag);
        //});
         
       }
       else if(total>=21 && total<=30){
        //$("#main-button").click(function(){ 
            let tag = "<input type='button' id='result-button' "+'onclick='+'"'+"location.href="+"'mbti2.php' "+'"'+" value='결과!' />";
            
            $("#test").append(tag);
         //});

      
       }
       else if(total>=31 && total<=40){
       // $("#main-button").click(function(){ 
            let tag = "<input type='button' id='result-button' "+'onclick='+'"'+"location.href="+"'mbti3.php' "+'"'+" value='결과!' />";
            
            $("#test").append(tag);
        // });
        
       }
       
       let btn = document.getElementById('main-button');
       btn.disabled = true;
     
}



