function display(table) {
  let tables = document.getElementsByTagName("table");
  if (table == "dashbord") {
    document.getElementById("dashbord").style.display = "flex";
    document.getElementById("table1").style.display = "none";
    document.getElementById("items").style.display = "none";
    document.getElementById("table2").style.display = "none";
    for (let i = 0; i < tables.length; i++) {
      document.getElementById(tables[i].id).style.display = "none";
    }
  }else if(table=="items"){
    document.getElementById(table).style.display = "block";
    for (let i = 0; i < tables.length; i++) {
      document.getElementById(tables[i].id).style.display = "none";
    }
    document.getElementById("dashbord").style.display = "none";
    document.getElementById("table1").style.display = "none";
    document.getElementById("table2").style.display = "none";


  } else if(table=="table1"){
    document.getElementById(table).style.display = "block";
    for (let i = 0; i < tables.length; i++) {
      document.getElementById(tables[i].id).style.display = "none";
    }
    document.getElementById("dashbord").style.display = "none";
    document.getElementById("table2").style.display = "none";
    document.getElementById("items").style.display = "none";


  }else if(table=="table2"){
    document.getElementById(table).style.display = "block";
    for (let i = 0; i < tables.length; i++) {
      document.getElementById(tables[i].id).style.display = "none";
    }
    document.getElementById("dashbord").style.display = "none";
    document.getElementById("table1").style.display = "none";
    document.getElementById("items").style.display = "none";


  }else{
    for (let i = 0; i < tables.length; i++) {
      if (tables[i].id == table) {
        document.getElementById(tables[i].id).style.display = "table";
        document.getElementById("dashbord").style.display = "none";
        document.getElementById("table1").style.display = "none";
        document.getElementById("table2").style.display = "none";
    document.getElementById("items").style.display = "none";

      } else {
        document.getElementById(tables[i].id).style.display = "none";
      }
    }
  }
}

let flg = false;
function slide(ele) {
  if (flg != true) {
    let x = document.getElementsByClassName("nav_link");
    let y = document.getElementsByClassName("main_a");
    for (let i = 0; i < x.length; i++) {
      x[i].style.display = "none";
      // y[i].style.textAlign='center';
    }
    document.getElementById("nav").style.width = "5%";
    for (let i = 0; i < y.length; i++) {
      y[i].style.justifyContent = "center";
    }
    let z = document.getElementsByClassName("buttons");
    for (let i = 0; i < z.length; i++) {
      z[i].style.paddingLeft = "0";
      // z[i].style.paddingTop='0.6rem';
    }
    let t = document.getElementsByClassName("nav_logo");
    for (let i = 0; i < t.length; i++) {
      t[i].style.fontSize = "1.4rem";
    }
    document.getElementById("main_logo_a").style.justifyContent = "center";
    let iconClass = ele.classList[ele.classList.length - 1];
    ele.classList.remove(iconClass);
    ele.classList.add("fa-bars");
    document.getElementById("main_container").style.width = "95%";
    flg = true;
  } else {
    let x = document.getElementsByClassName("nav_link");
    let y = document.getElementsByClassName("main_a");
    for (let i = 0; i < x.length; i++) {
      x[i].style.display = "block";
      // y[i].style.textAlign='center';
    }
    document.getElementById("nav").style.width = "18%";
    for (let i = 0; i < y.length; i++) {
      y[i].style.justifyContent = "start";
    }
    let z = document.getElementsByClassName("buttons");
    for (let i = 0; i < z.length; i++) {
      z[i].style.paddingLeft = "1rem";
    }
    let t = document.getElementsByClassName("nav_logo");
    for (let i = 0; i < t.length; i++) {
      t[i].style.fontSize = "1rem";
    }
    document.getElementById("main_logo_a").style.justifyContent =
      "space-between";
    let iconClass = ele.classList[ele.classList.length - 1];
    ele.classList.remove(iconClass);
    ele.classList.add("fa-angle-left");
    document.getElementById("main_container").style.width = "82%";
    flg = false;
  }
}
