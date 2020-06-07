function CreateRequest()
{
    var Request = false;

    if (window.XMLHttpRequest)
    {
        //Gecko-совместимые браузеры, Safari, Konqueror
        Request = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        //Internet explorer
        try
        {
             Request = new ActiveXObject("Microsoft.XMLHTTP");
        }    
        catch (CatchException)
        {
             Request = new ActiveXObject("Msxml2.XMLHTTP");
        }
    }
 
    if (!Request)
    {
        alert("Невозможно создать XMLHttpRequest");
    }
    
    return Request;
}

/*
Функция посылки запроса к файлу на сервере
r_method  - тип запроса: GET или POST
r_path    - путь к файлу
r_args    - аргументы вида a=1&b=2&c=3...
r_handler - функция-обработчик ответа от сервера
*/
function SendRequest(r_method, r_path, r_args, r_handler)
{
    //Создаём запрос
    var Request = CreateRequest();
    
    //Проверяем существование запроса еще раз
    if (!Request)
    {
        return;
    }
    
    //Назначаем пользовательский обработчик
    Request.onreadystatechange = function()
    {
        //Если обмен данными завершен
        if (Request.readyState == 4)
        {
            r_handler(Request);
        }
    }
    
    //Проверяем, если требуется сделать GET-запрос
    if (r_method.toLowerCase() == "get" && r_args.length > 0)
    r_path += "?" + r_args;
    
    //Инициализируем соединение
    Request.open(r_method, r_path, true);
    
    if (r_method.toLowerCase() == "post")
    {
        //Если это POST-запрос
        
        //Устанавливаем заголовок
        Request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
        //Посылаем запрос
        Request.send(r_args);
    }
    else
    {
        //Если это GET-запрос
        
        //Посылаем нуль-запрос
        Request.send(null);
    }
}

function ValidateForm(cls) {
    document.addEventListener('click', function(event) {
        event.preventDefault();
        if (event.target.tagName === "BUTTON") {
            if (cls.action === "signin")
                document.querySelector('.error_form.unvailable').classList.remove("display");
            else
                document.querySelector('.error_form.wrong_data').classList.remove("display");
            document.querySelector('.form_border.login').classList.remove("error"); 
            document.querySelector('.form_border.password').classList.remove("error"); 
            document.querySelector("form").classList.remove("error");
            var allGood = true;
            var login = document.querySelector("#login").value;
            var password = document.querySelector("#password").value;
            if (/^[a-zA-Z0-9]+$/.test(login) === false || login.length <= 2) {
                allGood = false;
                document.querySelector('.form_border.login').classList.add("error");
                document.querySelector('.error_form.login').classList.add("display");
            } else {
                document.querySelector('.form_border.login').classList.remove("error"); 
                document.querySelector('.error_form.login').classList.remove("display");
            }
            if (/^[a-zA-Z0-9]+$/.test(password) === false || password.length <= 2) {
                allGood = false;
                document.querySelector('.form_border.password').classList.add("error");
                document.querySelector('.error_form.password').classList.add("display");
            } else {
                document.querySelector('.error_form.password').classList.remove("display");
                document.querySelector('.form_border.password').classList.remove("error"); 
            }
            if (!allGood) {
                document.querySelector("form").classList.add("error");
            } else if (cls.action === "login") {
                Login(login, password);
            } else {
                Registr(login, password);
            }
        }
        if (event.target.tagName === "A") {
            window.location.replace(event.target.getAttribute("href"));
        }
        
    });
}

function Login(login, password) {
    var req = SendRequest("get", "login.php", "login=" + login + "&" + "passwd=" + password, function (res) {
        if (res.response === "true") {
            window.location.replace("market.php");
        } else {
            document.querySelector('.error_form.wrong_data').classList.add("display");
        }
    });
}

function Registr(login, password) {
    SendRequest("get", "registr.php", "login=" + login + "&" + "passwd=" + password, function (res) {
        if (res.response === "true") {
            window.location.replace("market.php");
        } else {
            document.querySelector('.form_border.login').classList.add("error");
            document.querySelector('.error_form.unvailable').classList.add("display");
        }
    });
}

function create_cart(i, price, category, name_pr, src, del) {
    var check = document.createElement("div");
    if (del)
        check.classList.add("delete");
    else 
        check.classList.add("check");
    var checkbox = document.createElement("input");
    checkbox.setAttribute("type", "checkbox");
    checkbox.setAttribute("id", "check_" + i);
    var label = document.createElement("label");
    label.setAttribute("for", "check_" + i);
    var name = document.createElement("div");
    name.classList.add("name");
    name.innerHTML = (name_pr ? name_pr : "product")
    var info = document.createElement("div");
    info.classList.add("info");
    var info_icon = document.createElement("div");
    info_icon.classList.add("icon");
    info_icon.innerHTML = "Category: " + (category ? category : "none");
    var price_span = document.createElement("span");
    price_span.innerHTML = price + "$";
    var price = document.createElement("div");
    price.classList.add("price");
    var picture_img = document.createElement("img");
    picture_img.setAttribute("src", src);
    var picture = document.createElement("div");
    picture.classList.add("picture");
    var card = document.createElement("div");
    card.setAttribute("id", "card_" + i);
    card.classList.add("card");
    check.appendChild(checkbox);
    check.appendChild(label);
    info.appendChild(info_icon);
    picture.appendChild(picture_img);
    price.appendChild(price_span);
    card.appendChild(picture);
    card.appendChild(info);
    card.appendChild(price);
    card.appendChild(name);
    card.appendChild(check);
    document.querySelector(".products").appendChild(card);
}
