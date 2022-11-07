/* js btn more categories */
$('.categories').addClass('solv-height');
$('.more span').click(function(){
    $('.categories').toggleClass('solv-height');
})

/* js items section */
$('.open-section').click(function(){
      $('.items-sections').toggleClass('hide');
      $('.open-section').toggleClass('active');
})

/* js menu toggle */

$('.toggle').click(function(){
    $('.header .menu .menu-list').toggleClass('hiddin');
})
$('.toggle-dash').click(function(){
    $('.dash-header .dash-menu nav').toggleClass('show');
})
/* js loading */
$(document).ready(function(){
    $('.loading').css('display','none');
})

// appoinment data
let patientname=document.getElementById('patientname');
let appoinmentdate=document.getElementById('appoinmentdate');
let appoinmenttime=document.getElementById('appoinmenttime');
let btnappoinment=document.getElementById('btn-appoinment');
let dataAppoinment;
// get data appoinment
btnappoinment.addEventListener('click',function(){
    getDataAppoinment();
})
if(localStorage.AppoinmentPatient!=null){
    dataAppoinment=JSON.parse(localStorage.AppoinmentPatient);
    displayDataAppoinment()
}else{
    dataAppoinment=[];
}
function getDataAppoinment(){
    let newAppoinment={
        patientname:patientname.value,
        appoinmentdate:appoinmentdate.value,
        appoinmenttime:appoinmenttime.value,
    }
    dataAppoinment.push(newAppoinment);
    localStorage.setItem('AppoinmentPatient',JSON.stringify(dataAppoinment));
    displayDataAppoinment();
}
function displayDataAppoinment(){
    let text='';
    for(let i=0;i<dataAppoinment.length;i++){
        text+=`
                <tr>
                <th scope="row">${i+1}</th>
                <td>${dataAppoinment[i].patientname}</td>
                <td>${dataAppoinment[i].appoinmentdate}</td>
                <td>${dataAppoinment[i].appoinmenttime}</td>
                <td>
                    <div class="group-btn">
                        <a class="active" href="#!">
                            cancel
                        </a>
                        <a href="#!">
                            accept
                        </a>
                        <a href="#!">
                            waiting
                        </a>
                    </div>
                </td>
                <td>
                    <a class="btn-delete" href="#!">
                        delete
                    </a>
                </td>
            </tr>
        `;
    }
    document.getElementById('tobody-appoinment').innerHTML=text;
    console.log('hi')
}