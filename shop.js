let CartCount = document.querySelector(".cart-count");
let cart = document.querySelectorAll(".addcart")
let products = [
       {
         name: "MacBook Air",
         price: 999,
         incart: 0
       },
       {
         name: "MacBook Pro 13",
         price: 1399,
         incart: 0
       },
       {
         name: "MacBook Pro 16",
         price: 2399,
         incart: 0
       },
       {
         name: "iPhone 12",
         price: 699,
         incart: 0
       },
       {
         name: "iPhone 12 Pro",
         price: 999,
         incart: 0
       },
       {
         name: "iPhone 12 Mini",
         price: 599,
         incart: 0
       }
];
for(let i=0; i < cart.length;i++){
  cart[i].addEventListener("click",()=>{
     CartNumber(products[i]);
     totalcost(products[i]);
  });
}
function onloadCart(){
  let productnum = localStorage.getItem('CartNumber');
  CartCount.textContent = productnum;
}
function CartNumber(product){

  let productnum = localStorage.getItem('CartNumber');
  productnum = parseInt(productnum);

  if(productnum){
    localStorage.setItem('CartNumber', productnum + 1);
    CartCount.textContent = productnum + 1;
  }else{
    localStorage.setItem('CartNumber', 1);
    CartCount.textContent = 1;
  }
  setItem(product);
}
function setItem(product){
  let cartitem = localStorage.getItem("Cartbox");

  cartitem = JSON.parse(cartitem);
  if(cartitem != null){
    if(cartitem[product.name] == undefined){
       cartitem = {
            ...cartitem,
            [product.name] : product
      }
  }
    cartitem[product.name].incart += 1
  }else{
    product.incart = 1;
    cartitem ={
      [product.name] : product
    }
  }

  localStorage.setItem("Cartbox", JSON.stringify(cartitem));
}
function totalcost(product){
  let Cartcost = localStorage.getItem("TotalCost");
  if(Cartcost != null){
    Cartcost = parseInt(Cartcost);
    localStorage.setItem("TotalCost", Cartcost + product.price);
  }else{
    localStorage.setItem("TotalCost",product.price);
  }

}
function displayCart(){
  let Cartcost = localStorage.getItem("TotalCost");
  let productcontainer = document.querySelector(".products")
  let cartitem = localStorage.getItem("Cartbox");
  cartitem = JSON.parse(cartitem);
  if(cartitem && productcontainer){
    Object.values(cartitem).map(item =>{
       productcontainer.innerHTML += `
      <div class="product-place">
      <div class="grid-container">
          <span class="remove">X</span>
          <div>$${item.name}</div>
          <div>$${item.price}</div>
          <div>${item.incart}</div>
          <div>$${item.incart * item.price}</div>
      </div>
      </div>
       `
    });
    productcontainer.innerHTML += `
      <div class="basket">
        <h3 class="ttcost">Total Cost</h3>
        <h3 class="res">$${Cartcost}</h3>
      </div>
    `
  }

}
 onloadCart();
displayCart();
let loginbox = document.querySelector(".login-form");
let signupbox = document.querySelector(".signup-form");
let signup = document.querySelector(".link1");
let login = document.querySelector(".link2");
let close = document.querySelector(".close-box");
let menulogin = document.querySelector(".menu-login");
signup.addEventListener("click",()=>{
 loginbox.classList.add("active");
 signupbox.classList.remove("active");
});
login.addEventListener("click",()=>{
 loginbox.classList.remove("active");
 signupbox.classList.add("active");
});
close.addEventListener("click",()=>{
 document.querySelector(".login-section").classList.add("active");
});
menulogin.addEventListener("click",()=>{
 document.querySelector(".login-section").classList.remove("active");
});
