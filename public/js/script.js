function logout() {
    var user_id = sessionStorage.getItem("user_id");
    var token = sessionStorage.getItem("token");
    url = "https://lunch-app.dev.local/signout";
    data = { user_id: user_id, token: token };

    params = {
        method: "post",
        headers: {
            "Content-type": "application/json",
            "Access-Control-Allow-Origin": "*",
        },
        body: JSON.stringify(data),
    };

    fetch(url, params).then(function (response) {
        if (response.status == 200) {
            sessionStorage.removeItem("user_id");
            sessionStorage.removeItem("name");
            sessionStorage.removeItem("token");
            sessionStorage.removeItem("date");
            sessionStorage.removeItem("code");
            sessionStorage.removeItem("mail");

            window.location.href = "https://lunch-app.dev.local/";
        } else if (response.status == 401) {
            alert("You are Unauthorized");
            location.reload();
        } else {
            alert("Something went wrong");
        }
    });
}

function offDay() {
    var user_id = sessionStorage.getItem("user_id");
    var token = sessionStorage.getItem("token");
    url = "https://lunch-app.dev.local/off-day";
    data = { user_id: user_id, token: token };
    params = {
        method: "post",
        headers: {
            "Content-type": "application/json",
        },
        body: JSON.stringify(data),
    };
    fetch(url, params)
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            date = data.map((obj) => {
                return {
                    title: "off-day",
                    start: obj.weekend,
                };
            });
            weekend(date);
            weekend_date = "";
            for (i = 0; i < data.length; i++) {
                weekend_date = weekend_date + data[i].weekend + ",";
            }
            localStorage.setItem("date", weekend_date);
        });
}

function arriveLunch() {
    var user_id = sessionStorage.getItem("user_id");
    var token = window.sessionStorage.getItem("token");

    url = "https://lunch-app.dev.local/lunch-taken";
    data = { user_id: user_id, token: token };
    params = {
        method: "post",
        headers: {
            "Content-type": "application/json",
        },
        body: JSON.stringify(data),
    };
    fetch(url, params).then(function (response) {
        if (response.status == 409) {
            alert("You already taken Lunch");
            location.reload();
        } else if (response.status == 404) {
            alert("Something went wrong");
            location.reload();
        } else if (response.status == 401) {
            alert("You are Unauthorized");
            location.reload();
        } else {
            alert("Enjoy your Lunch!");
            location.reload();
            return response.json();
        }
    });
}

function disable_arrive_button() {
    var today = new Date(),
        month = "" + (today.getMonth() + 1),
        day = "" + today.getDate(),
        tommorowDay = "" + (today.getDate() + 1),
        year = today.getFullYear();

    if (month.length < 2) {
        month = "0" + month;
    }
    if (day.length < 2) {
        day = "0" + day;
    }
    if (tommorowDay.length < 2) {
        tommorowDay = "0" + tommorowDay;
    }
    formatDate = [year, month, day].join("-");
    tommorowFormatDate = [year, month, tommorowDay].join("-");
    dateString = localStorage.getItem("date");
    dateArray = dateString.split(",");
    for (var i = 0; i <= dateArray.length; i++) {
        if (dateArray[i] == tommorowFormatDate) {
            document.getElementById("off_day_heading").innerHTML =
                "Tomorrow is Off-Day!!!";
        } else if (dateArray[i] == formatDate) {
            document.getElementById("arrive_lunch").disabled = true;
            document.getElementById("off_day_heading").innerHTML =
                "Today is Off-Day!!!";
            break;
        }
    }
}

function enable_arrive_button() {
    const t = new Date();
    let h = t.getHours();
    let m = t.getMinutes();
    if (h >= 12 && h < 15) {
        if ((h == 12 && m >= 30) || h == 13) {
            document.getElementById("arrive_lunch").disabled = false;
        } else if (m <= 30 && h == 14) {
            document.getElementById("arrive_lunch").disabled = false;
        } else {
            document.getElementById("arrive_lunch").disabled = true;
        }
    } else {
        document.getElementById("arrive_lunch").disabled = true;
    }
}
