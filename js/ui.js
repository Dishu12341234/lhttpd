var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
var date = new Date();


var initialise = (keyWord, defaultValue,runCheck=true) => {
    if (window.localStorage.getItem(keyWord) == null || !runCheck) {
        window.localStorage.setItem(keyWord, defaultValue);
    }
};

var setter = document.getElementById('setter');
var timerDisplay = document.getElementById('timer');

var setItem = (key, value) => {
    window.localStorage.setItem(key, value);
};

var getItem = (key) => {
    return window.localStorage.getItem(key);
};

var fields = ['CurrentMonth', 'CurrentYear', 'CurrentDayIndex', 'CurrentTime', 'CurrentStatus', 'TODO', 'Message', 'TimeStudied', 'CurrentTimeInMSRef1970'];
fields.forEach(el => {
    initialise(el, 0);
});

if (getItem('CurrentStatus') === '0' || getItem('CurrentStatus') === 'inactive') {
    setter.innerText = 'Start';
} else {
    setter.innerText = 'Stop';
}

setItem(fields[0], months[date.getMonth()]);
setItem(fields[1], date.getFullYear());
setItem(fields[2], date.getDate());
setItem(fields[3], `${date.getHours()}:${date.getMinutes()}:${date.getSeconds()} ${date.getTimezoneOffset() / 60}`);

var formatTime = (totalSeconds) => {
    var seconds = totalSeconds % 60;
    var minutes = Math.floor((totalSeconds / 60) % 60);
    var hours = Math.floor(totalSeconds / 3600);
    return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
};

// let timer;

var updateTimerDisplay = () => {
    var elapsed = Math.floor((new Date().getTime() - Number(getItem(fields[8]))) / 1000);
    timerDisplay.innerText = formatTime(elapsed);
};

var clickHandler = () => {
    if (getItem(fields[4]) === 'inactive') {
        let TODO = prompt('What is on your TODO list today?', 'Enter Here');
        if (TODO === null || TODO.trim() === '') {
            setItem(fields[5], 'Empty');
            alert('Please enter something in TODO to start the counter');
        } else {
            fields.forEach(el => {
                initialise(el, 0);
            });
            setItem(fields[8], new Date().getTime());
            setItem(fields[5], TODO);
            setItem(fields[4], 'active');
            setter.innerText = 'Stop';
            timer = setInterval(updateTimerDisplay, 1000); // Update every second
        }
    } else {
        setItem(fields[7], Math.abs(Number(getItem(fields[8])) - (new Date().getTime())) / 60000);
        setItem(fields[4], 'inactive');
        setter.innerText = 'Start';
        clearInterval(timer);

        var requestBody = {
            CurrentMonth: getItem(fields[0]),
            CurrentYear: getItem(fields[1]),
            CurrentDayIndex: getItem(fields[2]),
            CurrentTime: getItem(fields[3]),
            CurrentStatus: getItem(fields[4]),
            TODO: getItem(fields[5]) || 'EMPTY',
            TimeStudied: getItem(fields[7]),
        };

        fetch('data', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(requestBody),
        })
        .then(response => response.json())
        .then(data => {console.log(data);window.location.reload();
        })
        .catch(error => console.error('Error:', error));
    }
};

setter.addEventListener("click", clickHandler);

if (getItem(fields[4]) === 'active') {
    timer = setInterval(updateTimerDisplay, 1000); // Start the timer if already active
}

// var myChart = new Chart("myChart", {
//     type: "line",
//     data: {},
//     options: {}
//   });