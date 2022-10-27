
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab
var wishlist = [];
function buy(data){
  data = data.split(',');
  // data.push(data[3])
  // data.push(1)
  console.log(data)
  if(wishlist.length == 0){
    wishlist.push(data);

  }else{
    var cek =0;
    for (let index = 0; index < wishlist.length; index++) {
      const element = wishlist[index];
      // console.log('el',element)
      console.log('d',data[0] == element[0])
      if(element[0] == data[0]){
        cek++;
      }
    }

    if(cek == 0) wishlist.push(data);
  }
  
  generatewishlist();
  counttotal()
}

function countSubtotal(harga,id){
  let qty = document.getElementById('input-'+id).value;
  console.log(qty)
  let subTotal = Number(harga) * Number(qty);
  console.log(subTotal)
  document.getElementById('harga-'+id).innerHTML = subTotal
  for (let index = 0; index < wishlist.length; index++) {
    const element = wishlist[index];
    if(element[0] == id){
      element[9] = subTotal
      element[10] = qty || 1
    }
    
  }
counttotal();
}
function counttotal(){
  var total = 0;
  for (let index = 0; index < wishlist.length; index++) {
    const element = wishlist[index];
    total = total+( Number(element[9]) || Number(element[3]));    
  }
  var hargaTotal = document.getElementById('total-harga')
  hargaTotal.innerHTML = total
}

function generatewishlist(){
  let html='';
  wishlist.map(dt=>{
    let discount = (dt[5] / 100) * dt[3];
    let harga = dt[3] - discount;  
    html += `<div id='${dt[0]}' class="containt d-flex space-between listtt" style="width:100%;">
        <div class="row d-flex">
          <div class="image">

          </div>
          <div class="wrap-content">
            <h5>${dt[2]}</h5>
            <div class="kotak d-flex">
              <input type="number" value="1" min="1" id='input-${dt[0]}' oninput="countSubtotal(${harga},'${dt[0]}')"><h4>${dt[7]}</h4>
            </div>
            
            <h3 id='harga-${dt[0]}'>Rp. ${harga}</h3>
          </div>
    </div>
</div>`;
  })

  document.getElementById('wish-list').innerHTML=html
}
async function transaction(){
  let base_url = document.getElementById('base_url').innerHTML
  let data ={
    total :document.getElementById('total-harga').innerHTML,
    data : wishlist
  }
  let dataToPush = []
  for (let index = 0; index < wishlist.length; index++) {
    const element = wishlist[index].toString().replaceAll(',','|');
    dataToPush.push(element);
  }

  console.log(dataToPush)
 
  let formData = new FormData();
  formData.append('total',data.total)
  formData.append('data',dataToPush)

  let postData= await fetch(base_url, {
    method: 'POST',
    mode:'no-cors',
    headers:{
      'Content-Type': 'application/json'
    },
    body:formData
  })

  let response=await postData.json()
  console.log(response)
}
function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == 1) {
    document.getElementById("nextBtn").innerHTML = "CONFIRM";
  } else {
    document.getElementById("nextBtn").innerHTML = "CHECKOUT";
  }
  if(n==2){
    document.getElementById("prevBtn").style.display = "none";
    document.getElementById("nextBtn").style.display = "none";
    document.getElementById("stepper").style.display = "none";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }

  if(currentTab == 2){
    transaction()
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

