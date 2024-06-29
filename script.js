function signin() {


    var pop = document.getElementById("single");
    k = new bootstrap.Modal(pop);
    k.show();

}

function changeView() {

    var signInBox = document.getElementById("signinbox");
    var signUpBox = document.getElementById("signupbox");

    var title1 = document.getElementById("title1")
    var title2 = document.getElementById("title2");

    title1.classList.toggle("d-none");
    title2.classList.toggle("d-none");

    signInBox.classList.toggle("d-none");
    signUpBox.classList.toggle("d-none");

}


function signUp() {
    var fname = document.getElementById("fname")
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var repassword = document.getElementById("repassword")
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");


    var f = new FormData();
    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("email", email.value);
    f.append("password", password.value);
    f.append("repassword", repassword.value);
    f.append("mobile", mobile.value);
    f.append("gender", gender.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                changeView();
                fname.value = "";
                lname.value = "";
                email.value = "";
                password.value = "";
                repassword.value = "";
                mobile.value = "";
                document.getElementById("messageSignup").innerHTML = "";


            } else {
                var message = document.getElementById("messageSignup");
                message.innerHTML = text;
            }

        }

    }
    r.open("POST", "signUpProcess.php", true);
    r.send(f);
}

function signIn() {

    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var remember = document.getElementById("remember");


    var formData = new FormData();
    formData.append("email", email.value);
    formData.append("password", password.value);
    formData.append("remember", remember.checked);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t === "Success") {

                window.location = "index.php";

            } else {
                document.getElementById("messegesignin").innerHTML = t;

            }
        };
    }
    r.open("POST", "signInProcess.php", true);
    r.send(formData);

}

function profile() {

    alert();

}

var bm;

function forgotPassword() {

    var email = document.getElementById("email2")

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Success") {
                alert("Email varification sent. Please check your inbox.");

                var m = document.getElementById("forgetPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();

            } else {
                alert(text);
            }
        }
    };
    r.open("GET", "forgotPasswordprocess.php?e=" + email.value, true);
    r.send()

}

function showPassword1() {
    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (npb.innerHTML == "Show") {
        np.type = "text";
        npb.innerHTML = "Hide";
    } else {
        np.type = "password";
        npb.innerHTML = "Show";
    }
}

function showPassword2() {
    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnpb.innerHTML == "Show") {
        rnp.type = "text";
        rnpb.innerHTML = "Hide";
    } else {
        rnp.type = "password";
        rnpb.innerHTML = "Show";
    }
}


function resetPassword() {
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");
    var email = document.getElementById("email2");

    var formData = new FormData();
    formData.append("e", email.value);
    formData.append("np", np.value);
    formData.append("rnp", rnp.value);
    formData.append("vc", vc.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "1") {
                alert("Password Reset success");

                var m = document.getElementById("forgetPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.close();


            } else {
                alert("Password Reset Fail")
            }
        }
    };
    r.open("POST", "resetpassword.php", true);
    r.send(formData);

}

function adminverification() {
    var e = document.getElementById("e").value;

    var f = new FormData();
    f.append("e", e);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                var verificationmodal = document.getElementById("verificationModal");
                k = new bootstrap.Modal(verificationmodal);
                k.show();

            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "adminverificationProcess.php");
    r.send(f);
}


function Verify() {

    var code = document.getElementById("v");

    var formData = new FormData();
    formData.append("code", code.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {

            var t = r.responseText;
            if (t == "success") {

                k.hide();
                window.location = "adminhomepage.php";
            } else {

                alert(t);
            }

        }

    }
    r.open("POST", "verificationprocess.php", true);
    r.send(formData);

}

function addcategory() {



    var pop = document.getElementById("addnewmodal");
    k = new bootstrap.Modal(pop);
    k.show();
}

function saveCategory() {


    var txt = document.getElementById("categorytxt");
    var image = document.getElementById("imguploader");

    var form = new FormData();
    form.append("category", txt.value);
    form.append("image", image.files[0]);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var t = r.responseText;
            if (t == "success") {
                k.hide();


                window.location = "adminhomepage.php";
            } else {
                alert(t);
            }
        }
    }
    r.open("POST", "addNewCategoryProcess.php", true);
    r.send(form);
}

function changeImg() {
    var image = document.getElementById("imguploader"); //file chooser
    var view = document.getElementById("prev"); //image tag

    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        view.src = url;
    }
}



function signOut() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text = "success") {

                window.location = "index.php";

            }

        }
    }
    r.open("GET", "signoutProcess.php", true);
    r.send();
}

function updateProfile() {
    var fname = document.getElementById("first_name");
    var lname = document.getElementById("last_name");
    var mobile = document.getElementById("mobile_number");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var city = document.getElementById("city");
    var img = document.getElementById("profileimg");

    // alert(fname);
    // alert(lname);
    // alert(mobile);
    // alert(line1);
    // alert(line2);
    // alert(city);
    // alert(img);


    var f = new FormData();
    f.append("f", fname.value);
    f.append("l", lname.value);
    f.append("m", mobile.value);
    f.append("a1", line1.value);
    f.append("a2", line2.value);
    f.append("c", city.value);
    f.append("i", img.files[0]);




    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var text = r.responseText;
            // alert(text);
            window.location = "userprofile.php";
            // if (text = "success") {
            //     alert("Update success");
            //     window.location = "userProfile.php";

            // } else {
            //     alert(text);
            // }

        }
    }
    r.open("POST", "UpdateProfileProcess.php", true);
    r.send(f);
}



function addProduct() {
    var category = document.getElementById("category").value;
    var brand = document.getElementById("brand").value;
    var model = document.getElementById("model").value;
    var title = document.getElementById("title").value;
    var condition;

    if (document.getElementById("brand_new").checked) {

        condition = "1";

    } else if (document.getElementById("used").checked) {

        condition = "2";
    }

    var color = document.getElementById("color").value;
    var qty = document.getElementById("qty").value;
    var price = document.getElementById("price").value;
    var delivery_cost = document.getElementById("delivery_cost").value;
    var description = document.getElementById("description").value;
    var ins = document.getElementById('fileToUpload').files.length;


    // alert(category);
    // alert(brand);
    // alert(model);
    // alert(title);
    // alert(condition);
    // alert(color);
    // alert(qty);
    // alert(price);
    // alert(delivery_cost);
    // alert(description);
    // alert(ins);



    var form = new FormData();
    form.append("c", category);
    form.append("b", brand);
    form.append("m", model);
    form.append("t", title);
    form.append("con", condition);
    form.append("col", color);
    form.append("q", qty);
    form.append("p", price);
    form.append("d", delivery_cost);
    form.append("des", description);
    for (var x = 0; x < ins; x++) {
        form.append("fileToUpload[]", document.getElementById('fileToUpload').files[x]);
    }



    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {

            var text = r.responseText
            alert(text);

            if (text == "product Added to the database sucessfully") {

                location.reload();

            }
        }

    }
    r.open("POST", "addProductProcess.php", true);
    r.send(form);


}

function upload() {
    var ins = document.getElementById('fileToUpload').files.length;
    var form = new FormData();
    for (var x = 0; x < ins; x++) {
        form.append("fileToUpload[]", document.getElementById('fileToUpload').files[x]);
    }

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var text = r.responseText;
            alert(text);
            window.location = "addProduct.php";

        }


    }
    r.open("POST", "testprocess.php", true);
    r.send(form);

}

function search() {

    var search = document.getElementById("search_txt").value;

    var view = document.getElementById("view");

    var form = new FormData();
    form.append("s", search);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {

            var text = r.responseText;
            if (text == "Please Enter Text to Search") {

                alert("Please Enter Text to Search");
            } else {

                view.innerHTML = text;
                document.getElementById("slider").className = "d-none";
                document.getElementById("product").className = "d-none";
                document.getElementById("category").className = "d-none";


            }




        }

    };
    r.open("POST", "bsicSearchProcess.php", true);
    r.send(form);

}

function addToCart(id) {
    var qtytxt = document.getElementById("qtytxt" + id).value;
    var pid = id;

    var form = new FormData();
    form.append("p", pid);
    form.append("q", qtytxt);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {

            var text = r.responseText;
            if (text == "Pease Log In First") {

                alert(text);
                window.location = "index.php";
            } else if (text == "success") {
                window.location = "cart.php";

            } else {

                alert(text);

            }




        }

    };
    r.open("POST", "cartProcess.php", true);
    r.send(form);

}

function addToWatchList(id) {

    var qtytxt = document.getElementById("qtytxt" + id).value;
    var pid = id;

    var form = new FormData();
    form.append("p", pid);
    form.append("q", qtytxt);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {

            var text = r.responseText;
            if (text == "Pease Log In First") {

                alert(text);
                window.location = "index.php";
            } else if (text == "success") {
                window.location = "watchlist.php";

            } else {

                alert(text);

            }




        }

    };
    r.open("POST", "watchlistProcess.php", true);
    r.send(form);
}

function categoryProducts(id) {



    var search = id;

    var view = document.getElementById("view");

    var form = new FormData();
    form.append("s", search);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {

        if (r.readyState == 4) {

            var text = r.responseText;
            if (text == "Please Enter Text to Search") {

                alert("Please Enter Text to Search");
            } else {

                view.innerHTML = text;
                document.getElementById("slider").className = "d-none";
                document.getElementById("product").className = "d-none";
                document.getElementById("category").className = "d-none";


            }




        }

    };
    r.open("POST", "categoryProducts.php", true);
    r.send(form);

}

function goToCart() {

    window.location = "cart.php";

}

function deletefromCart(id) {
    var cid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert("error");
            }
        }
    }
    r.open("GET", "deleteFromCartProcess.php?id=" + cid, true);
    r.send();
}

var obj;

function paynow(qty, pid) {

    var quantity = qty;
    var product_id = pid;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var t = r.responseText;


            obj = JSON.parse(t);

            //  alert(t);

        }
    }

    r.open("GET", "buyNowProcess.php?id=" + product_id + "&qty=" + quantity, true);
    r.send();



}

function saveInvoice() {



    var order_id = obj["order_id"];
    var product_title = obj["title"];
    var amount = obj["amount"];
    var line1 = obj["line1"];
    var line2 = obj["line2"];
    var city = obj["city"];
    var product_id = obj["id"];
    var qty = obj["qty"];
    //   alert(qty);
    var f = new FormData();
    f.append("order", order_id);
    f.append("title", product_title);
    f.append("price", amount);
    f.append("first_line", line1);
    f.append("second_line", line2);
    f.append("city_name", city);
    f.append("pid", product_id);
    f.append("quantity", qty);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var t = r.responseText;


            window.location = "invoice.php?id=" + order_id;


        }

    }
    r.open("POST", "saveInvoice.php", true);
    r.send(f);
}

paypal.Buttons({



    style: {
        color: 'blue',
        shape: 'pill'
    },
    // createOrder: function(data, actions) {
    //     return actions.order.create({
    //         purchase_units: [{
    //             amount: {
    //                 value: '0.1'
    //             }
    //         }]
    //     });
    // },

    createOrder: (data, actions) => {


        var qty = document.getElementById("qtyinput").value;
        var pid = document.getElementById("product_id").textContent;
        var stock_qyty = document.getElementById("stock").textContent;

        paynow(qty, pid);


        if (qty > 0 && qty < stock_qyty) {


            return actions.order.create({
                "purchase_units": [{
                    "amount": {
                        "currency_code": "USD",
                        "value": obj["amount"],
                        "breakdown": {
                            // "item_total": { /* Required when including the items array */
                            //     "currency_code": "USD",
                            //     "value": "15"
                            // }
                        }
                    },
                    // "items": [{
                    //     "name": "First Product Name",
                    //     /* Shows within upper-right dropdown during payment approval */
                    //     "description": "Optional descriptive text..",
                    //     /* Item details will also be in the completed paypal.com transaction view */
                    //     "unit_amount": {
                    //         "currency_code": "USD",
                    //         "value": "5"
                    //     },
                    //     "quantity": obj["id"]
                    // }, ]
                }]
            });


        } else {

            alert("Stock Quantity is invalid");

        }






    },

    onApprove: function(data, actions) {

        return actions.order.capture().then(function(details) {
            console.log(details)
            saveInvoice();

            //  window.location.replace("http://localhost:8090/gwc/success.php")





        })



    },




    onCancel: function(data) {
        window.location.replace("http://localhost:8090/gwc/singleProductView.php?id=" + pid)
    }

}).render('#paypal-payment-button');



function qty_inc() {
    var input = document.getElementById("qtyinput");
    var newvalue = parseInt(input.value) + 1;

    input.value = newvalue.toString();
}

function qty_dec() {
    var input = document.getElementById("qtyinput");

    if (input.value >= 1) {


        var newvalue = parseInt(input.value) + 1;

        input.value = newvalue.toString();
    } else {
        alert("Minimum quantity count has been achieved.");
    }
}

function printDiv() {
    // var divContents = document.getElementById("GFG").innerHTML;
    // var a = window.open('', '', 'height=500, width=500');
    // a.document.write('<html>');
    // a.document.write('<body > <h1>Div contents are <br>');
    // a.document.write(divContents);
    // a.document.write('</body></html>');
    // a.document.close();
    // a.print();

    var restorepage = document.body.innerHTML;
    var page = document.getElementById("GFG").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;

}

function searchProduct() {

    var text = document.getElementById("searchtxt").value;
    var viewProduct = document.getElementById("viewProduct");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            viewProduct.innerHTML = t;
        }
    }

    r.open("GET", "searchProduct.php?s=" + text, true);
    r.send();
}


function productDetails(pid) {

    var product_id = pid;
    var myModal = document.getElementById('staticBackdrop');
    var productView = document.getElementById("view");


    var f = new FormData();
    f.append("pid", product_id);



    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var t = r.responseText;
            //  alert(t);
            productView.innerHTML = t;



        }

    }
    r.open("POST", "manageProductProcess.php", true);
    r.send(f);

    k = new bootstrap.Modal(myModal);
    k.show();


}

function changeProductStatus(id) {

    var product = document.getElementById("product_id").value;
    //  alert(id);
    status_type = "0";
    var pro_id = id;

    if (pro_id == "1") {

        status_type = "2";
    } else if (pro_id == "2") {

        status_type = "1";
    }

    var f = new FormData();
    f.append("sid", status_type);
    f.append("pid", product);



    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var t = r.responseText;
            alert(t);




        }

    }
    r.open("POST", "changeStatusTypeProcess.php", true);
    r.send(f);

}

/////////////////////////////////

function searchUser() {

    var text = document.getElementById("searchtxt").value;
    var viewUser = document.getElementById("viewProduct");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            viewUser.innerHTML = t;
        }
    }

    r.open("GET", "searchUser.php?s=" + text, true);
    r.send();
}


function userDetails(pid) {

    var product_id = pid;

    var myModal = document.getElementById('staticBackdrop');
    var productView = document.getElementById("view");


    var f = new FormData();
    f.append("pid", product_id);



    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {

            var t = r.responseText;
            //  alert(t);
            productView.innerHTML = t;



        }

    }
    r.open("POST", "manageUserProcess.php", true);
    r.send(f);

    k = new bootstrap.Modal(myModal);
    k.show();


}

// function changeProductStatus(id) {

//     var product = document.getElementById("product_id").value;
//     //  alert(id);
//     status_type = "0";
//     var pro_id = id;

//     if (pro_id == "1") {

//         status_type = "2";
//     } else if (pro_id == "2") {

//         status_type = "1";
//     }

//     var f = new FormData();
//     f.append("sid", status_type);
//     f.append("pid", product);



//     var r = new XMLHttpRequest();
//     r.onreadystatechange = function() {
//         if (r.readyState == 4) {

//             var t = r.responseText;
//             alert(t);




//         }

//     }
//     r.open("POST", "changeStatusTypeProcess.php", true);
//     r.send(f);

// }
function advancedSearch() {

    var viewResults = document.getElementById("viewResults");

    var keyword = document.getElementById("k").value;
    var category = document.getElementById("c").value;
    var brand = document.getElementById("b").value;
    var model = document.getElementById("m").value;
    var condition = document.getElementById("con").value;
    var color = document.getElementById("clr").value;
    var pricefrom = document.getElementById("pf").value;
    var priceto = document.getElementById("pt").value;


    var f = new FormData();
    f.append('k', keyword);
    f.append('c', category);
    f.append('b', brand);
    f.append('m', model);
    f.append('con', condition);
    f.append('clr', color);
    f.append('pf', pricefrom);
    f.append('pt', priceto);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;



            viewResults.innerHTML = t;



        }
    }
    r.open("POST", "advancedSearchProcess.php", true);
    r.send(f);
}


function goToWatchList() {

    window.location = "watchList.php";

}

function deletefromWatchList(id) {
    var cid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert("error");
            }
        }
    }
    r.open("GET", "deleteFromWatchListProcess.php?id=" + cid, true);
    r.send();
}