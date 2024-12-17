function updateUserPanel() {
  const user = JSON.parse(localStorage.getItem("user"));

  if (user) {

    document.getElementById("user-name").textContent = user.name;
    document.getElementById("user-image").src = user.image || "default.jpg";
  }
}


let currentYear = new Date().getFullYear();
let currentMonth = new Date().getMonth();
let selectedDay = null;
let selectedDayElement = null;


let tasks = JSON.parse(localStorage.getItem("tasks")) || {};

function generateCalendar(year, month) {
  const dzisiaj = new Date();
  const dzienDzisiaj = dzisiaj.getDate();
  const czyDzisiaj = (year === dzisiaj.getFullYear() && month === dzisiaj.getMonth());

  const nazwyMiesiecy = [
    "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec",
    "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"
  ];

  const dniTygodnia = ["Pn", "Wt", "Śr", "Cz", "Pt", "So", "Nd"];

  const dniWMiesiacu = new Date(year, month + 1, 0).getDate();
  const pierwszyDzien = new Date(year, month, 1).getDay();
  const startDnia = (pierwszyDzien === 0 ? 6 : pierwszyDzien - 1);

  let html = `
        <div class="calendar-header">
            <button onclick="changeMonth(-1)">← Poprzedni</button>
            ${nazwyMiesiecy[month]} ${year}
            <button onclick="changeMonth(1)">Następny →</button>
        </div>
    `;

  html += "<table><thead><tr>";
  dniTygodnia.forEach(dzien => {
    html += `<th>${dzien}</th>`;
  });
  html += "</tr></thead><tbody><tr>";

  for (let i = 0; i < startDnia; i++) {
    html += "<td></td>";
  }

  for (let dzien = 1; dzien <= dniWMiesiacu; dzien++) {
    if ((startDnia + dzien - 1) % 7 === 0 && dzien !== 1) {
      html += "</tr><tr>";
    }

    const dzisiajKlasa = (czyDzisiaj && dzien === dzienDzisiaj) ? "today" : "";
    html += `<td class="calendar-day ${dzisiajKlasa}" onclick="selectDay(${year}, ${month}, ${dzien}, this)">${dzien}</td>`;
  }

  html += "</tr></tbody></table>";
  document.getElementById("calendar").innerHTML = html;
}

function changeMonth(direction) {
  currentMonth += direction;

  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear -= 1;
  } else if (currentMonth > 11) {
    currentMonth = 0;
    currentYear += 1;
  }

  generateCalendar(currentYear, currentMonth);
}

function selectDay(year, month, day, element) {

  if (selectedDayElement) {

    selectedDayElement.classList.remove("selected");
  }


  selectedDay = `${year}-${String(month + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`;
  selectedDayElement = element;


  selectedDayElement.classList.add("selected");

  updateTaskList();
}

function addTask() {
  if (!selectedDay) {
    alert("Wybierz dzień, zanim dodasz zadanie!");
    return;
  }

  const taskInput = document.getElementById("taskInput");
  const taskText = taskInput.value.trim();
  const startTimeInput = document.getElementById("startTime").value.trim();
  const endTimeInput = document.getElementById("endTime").value.trim();


  if (taskText === "") {
    alert("Zadanie nie może być puste!");
    return;
  }

  if (!isValidTime(startTimeInput) || !isValidTime(endTimeInput)) {
    alert("Proszę podać poprawny format godzin (HH:mm).");
    return;
  }

  if (!tasks[selectedDay]) {
    tasks[selectedDay] = [];
  }

  tasks[selectedDay].push({ task: taskText, startTime: startTimeInput, endTime: endTimeInput });
  taskInput.value = "";
  document.getElementById("startTime").value = "";
  document.getElementById("endTime").value = "";


  localStorage.setItem("tasks", JSON.stringify(tasks));

  updateTaskList();
}

function isValidTime(time) {

  const timeRegex = /^([01]?[0-9]|2[0-3]):([0-5]?[0-9])$/;
  return timeRegex.test(time);
}

function updateTaskList() {
  const taskList = document.getElementById("taskList");
  taskList.innerHTML = `<strong>Zadania na dzień ${selectedDay}:</strong>`;

  if (!tasks[selectedDay] || tasks[selectedDay].length === 0) {
    taskList.innerHTML += "<p>Brak zadań na ten dzień.</p>";
    return;
  }

  const list = document.createElement("ul");
  tasks[selectedDay].forEach((taskObj, index) => {
    const listItem = document.createElement("li");
    listItem.textContent = `${index + 1}. ${taskObj.task} (Godzina: ${taskObj.startTime} - ${taskObj.endTime})`;
    list.appendChild(listItem);
  });
  taskList.appendChild(list);
}

generateCalendar(currentYear, currentMonth);
