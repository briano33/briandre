// const canolaBtn=document.getElementById('canola-btn')
// const canolaName=document.getElementById('canola-name')
// const canolaAmount=document.getElementById('canola-amount')
// const canolaInputName=document.getElementById('canola-input-name')
// const canolaInputAmount=document.getElementById('canola-input-amount')
// const canolaInputNumber=document.getElementById('canola-input-number')

// canolaBtn.addEventListener('click',()=>{
//     canolaInputName.value=canolaName.textContent;
// })

// canolaInputNumber.addEventListener('blur',()=>{
//     canolaInputAmount.value=Number(canolaInputNumber.value)*Number(canolaAmount.textContent)
   
// })

//             // Combine Harvester 
// const combineBtn=document.getElementById('combine-btn')
// const combineName=document.getElementById('combine-name')
// const combineAmount=document.getElementById('combine-amount')
// const combineInputName=document.getElementById('combine-input-name')
// const combineInputAmount=document.getElementById('combine-input-amount')
// const combineInputNumber=document.getElementById('combine-input-number')

// combineBtn.addEventListener('click',()=>{
//     combineInputName.value=combineName.textContent;
    
// })
// combineInputNumber.addEventListener('blur',()=>{
//     combineInputAmount.value=Number(combineInputNumber.value)*Number(combineAmount.textContent)
// })

//             // GRAIN DRIER
// const dryerBtn=document.getElementById('dryer-btn')
// const dryerName=document.getElementById('dryer-name')
// const dryerAmount=document.getElementById('dryer-amount')
// const dryerInputName=document.getElementById('dryer-input-name')
// const dryerInputAmount=document.getElementById('dryer-input-amount')
// const dryerInputNumber=document.getElementById('dryer-input-number')

// dryerBtn.addEventListener('click',()=>{
//     dryerInputName.value=dryerName.textContent;
// })
// dryerInputNumber.addEventListener('blur',()=>{
//     dryerInputAmount.value=Number(dryerInputNumber.value)*Number(dryerAmount.textContent)
// })

//         // Hay Harvester
// const hayBtn=document.getElementById('hay-btn')
// const hayName=document.getElementById('hay-name')
// const hayAmount=document.getElementById('hay-amount')
// const hayInputName=document.getElementById('hay-input-name')
// const hayInputAmount=document.getElementById('hay-input-amount')
// const hayInputNumber=document.getElementById('hay-input-number')

// hayBtn.addEventListener('click',()=>{
//     hayInputName.value=hayName.textContent;
// })

// hayInputAmount.addEventListener('blur',()=>{
//     hayInputAmount.value=Number(hayInputNumber.value)*Number(hayAmount.textContent)
// })

//         // Maize Harvester
// const maizeBtn=document.getElementById('maize-btn')
// const maizeName=document.getElementById('maize-name')
// const maizeAmount=document.getElementById('maize-amount')
// const maizeInputName=document.getElementById('maize-input-name')
// const maizeInputAmount=document.getElementById('maize-input-amount')
// const maizeInputNumber=document.getElementById('maize-input-number')

// maizeBtn.addEventListener('click',()=>{
//     maizeInputName.value=maizeName.textContent;
    
// })

// maizeInputAmount.addEventListener('blur',()=>{
//     maizeInputAmount.value=Number(maizeInputNumber.value)*Number(maizeAmount.textContent)
// })


//         // Silage
// const silageBtn=document.getElementById('silage-btn')
// const silageName=document.getElementById('silage-name')
// const silageAmount=document.getElementById('silage-amount')
// const silageInputName=document.getElementById('silage-input-name')
// const silageInputAmount=document.getElementById('silage-input-amount')
// const silageInputNumber=document.getElementById('silage-input-number')

// silageBtn.addEventListener('click',()=>{
//     silageInputName.value=silageName.textContent;
//     silageInputAmount=Number(silageInputNumber.value)*Number(silageAmount.textContent)
// })

// silageInputAmount.addEventListener('blur',()=>{
//     silageInputAmount.value=Number(silageInputNumber.value)*Number(silageAmount.textContent)
// })

$(document).ready(function(){
            $('#canola-submit-btn').on("click", function(e){

                e.preventDefault();
                var machineName=$('#canola-input-name').val();
                var pickUpDate=$('#canola-pick-up-date').val();
                var returnDate=$('#canola-return-date').val();
                var userName=$('#canola-username').val();
                var phoneNumber=$('#canola-phone-number').val();
                var amount=$('#canola-input-amount').val();
                var numberOfMachines=$('#canola-input-number').val();
            
                    if(machineName !='' && pickUpDate !='' && returnDate !='' && userName !='' && phoneNumber !='' && amount !='' && numberofMachines !=''){
                        $.ajax({
                            url: "rentmachine.php",
                            method: "POST",
                            data:
                            {machineName: machineName, pickUpDate: pickUpDate,returnDate: returnDate,userName: userName,phoneNumber: phoneNumber,amount: amount,numberOfMachines: numberOfMachines},
                            success: function(response){
                                
                               if(response){
                                   $('#canola_msg').text(response);
                                }else{

                                    
                                    $('#canola_msg_success').text("order send successfully");

                                }
                            }
                            });
                    }else{
                        $('#canola_msg').text("All fields are required");
                    }
            });

        });
