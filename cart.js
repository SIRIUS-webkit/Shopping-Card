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
       productcontainer.textContent += `
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
    productcontainer.textContent += `
      <div class="basket">
        <h5 class="ttcost">Total Cost</h5>
        <h5 class="res">$${Cartcost}</h5>
      </div>
    `
  }

}
 // onloadCart();
displayCart();
let cartbox = localStorage.getItem("Cartbox");
cartbox = JSON.parse(cartbox);
let pdname = [];
let pdprice = [];
let pdquantity = [];
if(cartbox){
  Object.values(cartbox).map(item =>{
    pdname.push(item.name);
    pdprice.push(item.price);
    pdquantity.push(item.incart);
  });

  function InsertText(){
    document.getElementById("txt-area").value = pdname;
    document.getElementById("txt-area").innerHTML += pdprice;
    document.getElementById("txt-area").innerHTML += pdquantity;
  }
}
  console.log(pdname);
InsertText();
let CloseOrderBox = document.querySelector(".close-box-cart");
let CloseBtn = document.querySelector(".preorder");
CloseBtn.addEventListener("click",()=>{
  document.querySelector(".preorder-box").classList.remove("active");
});
CloseOrderBox.addEventListener("click",()=>{

  document.querySelector(".preorder-box").classList.add("active");
});
