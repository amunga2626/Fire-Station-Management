<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fire Station Management</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            color: #333;
            transition: background-color 0.5s;
        }

        header,
        nav,
        footer {
            background: #2C3E50;
            color: white;
            padding: 15px;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            background: #34495E;
            border-bottom: 2px solid #2C3E50;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 10px;
            padding: 12px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-weight: bold;
            letter-spacing: 1px;
            background: #3498DB;
        }

        nav a:hover {
            background-color: #2980B9;
        }

        section {
            margin: 20px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.5s;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 10px;
            padding: 15px;
            background-color: #ECF0F1;
            border-radius: 5px;
            transition: background-color 0.3s;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #BDC3C7;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        li:hover {
            background-color: #D5D8DC;
        }

        button {
            padding: 10px;
            background-color: #3498DB;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980B9;
        }

        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: transform 0.5s;
        }

        .modal input,
        .modal textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #BDC3C7;
            border-radius: 5px;
        }

        .modal button {
            width: 100%;
            padding: 10px;
            background-color: #3498DB;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .modal button:hover {
            background-color: #2980B9;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 900;
            transition: opacity 0.5s;
        }

        footer {
            margin-top: 20px;
            background: #34495E;
            color: white;
            text-align: center;
            padding: 15px;
        }

        @media screen and (max-width: 768px) {
            nav {
                flex-direction: column;
                align-items: flex-start;
            }

            nav a {
                margin: 5px;
            }
        }
    </style>
</head>

<body>

    <header>
        <h1 style="font-size: 2em;">Fire Station Management</h1>
    </header>

    <nav>
        <a href="#" onclick="toggleStationNames()">Station</a>
        <a href="#" onclick="toggleWatchNames()">Watches</a>
        <a href="#" onclick="openDataInputModal()">Appliances Available</a>
        <a href="#" onclick="updatePersonnelOnDuty()">Personnel on Duty</a>
        <a href="#" onclick="openOccurrenceBook()">Occurrence Book</a>
    </nav>

    <section id="contentSection">
        <!-- Dynamic content will be updated here -->
    </section>

    <footer>
        <p>&copy; 2024 Fire Station Management</p>
    </footer>

    <!-- Data Input Modal -->
    <div class="overlay" id="overlay"></div>
    <div class="modal" id="dataInputModal">
        <label for="category">Category:</label>
        <select id="category">
            <option value="Firefighters">Firefighters</option>
            <option value="Paramedics">Paramedics</option>
            <option value="Administrative Staff">Administrative Staff</option>
        </select>
        <label for="name">Name:</label>
        <input type="text" id="name" required>
        <label for="time">Time:</label>
        <input type="text" id="time" required>
        <label for="date">Date:</label>
        <input type="date" id="date" required>
        <textarea id="typingArea" placeholder="Type here..." rows="4" style="resize: none;"></textarea>
        <button onclick="savePersonnelData()">Save</button>
        <button onclick="closeDataInputModal()">Cancel</button>
    </div>

    <!-- Occurrence Book Modal -->
    <div class="modal" id="occurrenceBookModal">
        <h2>Occurrence Book</h2>
        <textarea id="occurrenceBookText" rows="10" cols="50" placeholder="Enter occurrence details..." style="resize: none;"></textarea>
        <br>
        <button onclick="saveOccurrenceBook()">Save</button>
        <button onclick="closeOccurrenceBook()">Close</button>
    </div>

    <script>
        function toggleStationNames() {
            var stationNames = "<p style='font-size: 1.2em;'><strong>Station Names:</strong></p><ul>" +
                "<li onclick='showCategories(\"Tom Mboya Fire Station\")'>Tom Mboya Fire Station</li>" +
                "<li onclick='showCategories(\"Enterprise Fire Station\")'>Enterprise Fire Station</li>" +
                "<li onclick='showCategories(\"Kangundo Road Fire Station\")'>Kangundo Road Fire Station</li>" +
                "<li onclick='showCategories(\"Ruaraka Fire Station\")'>Ruaraka Fire Station</li>" +
                "<li onclick='showCategories(\"Gigiri Fire Station\")'>Gigiri Fire Station</li>" +
                "<li onclick='showCategories(\"Waithaka Fire Station\")'>Waithaka Fire Station</li>" +
                "</ul>";

            updateContent(stationNames);
        }

        function toggleWatchNames() {
            var watchNames = "<p style='font-size: 1.2em;'><strong>Watch Names:</strong></p><ul>" +
                "<li>Green Watch</li>" +
                "<li>Red Watch</li>" +
                "<li>Blue Watch</li></ul>";

            updateContent(watchNames);
        }

        function showCategories(stationName) {
            var categories = "<p style='font-size: 1.2em;'><strong>Categories for " + stationName + ":</strong></p>" +
                "<table>" +
                "<tr><td><input type='text' placeholder='Firefighter'></td><td><button onclick='showPersonnelList(\"Firefighters\", \"" + stationName + "\")'>Show</button></td></tr>" +
                "<tr><td><input type='text' placeholder='Paramedic'></td><td><button onclick='showPersonnelList(\"Paramedics\", \"" + stationName + "\")'>Show</button></td></tr>" +
                "<tr><td><input type='text' placeholder='Administrative Staff'></td><td><button onclick='showPersonnelList(\"Administrative Staff\", \"" + stationName + "\")'>Show</button></td></tr>" +
                "</table>";

            updateContent(categories);
        }

        function openDataInputModal() {
            var overlay = document.getElementById('overlay');
            var modal = document.getElementById('dataInputModal');
            overlay.style.display = 'block';
            modal.style.display = 'block';
        }

        function closeDataInputModal() {
            var overlay = document.getElementById('overlay');
            var modal = document.getElementById('dataInputModal');
            overlay.style.display = 'none';
            modal.style.display = 'none';
        }

        function savePersonnelData() {
            var category = document.getElementById('category').value;
            var name = document.getElementById('name').value;
            var time = document.getElementById('time').value;
            var date = document.getElementById('date').value;
            var typingArea = document.getElementById('typingArea').value;

            if (category && name && time && date) {
                var personnelData = JSON.parse(localStorage.getItem('personnelData')) || {};
                personnelData[date] = personnelData[date] || {};
                personnelData[date][stationName] = personnelData[date][stationName] || {};
                personnelData[date][stationName][category] = personnelData[date][stationName][category] || [];

                personnelData[date][stationName][category].push({
                    name: name,
                    time: time,
                    date: date,
                    details: typingArea,
                    lastEdited: new Date().toLocaleString(),
                });

                localStorage.setItem('personnelData', JSON.stringify(personnelData));
                closeDataInputModal();
                showPersonnelList(category, stationName);
            }
        }

        function updatePersonnelOnDuty() {
            var personnelInfo = "<p style='font-size: 1.2em;'><strong>Personnel on Duty:</strong></p>" +
                "<p style='font-size: 1em;'>This section can be updated dynamically with the latest personnel information.</p>";

            updateContent(personnelInfo);
        }

        function updateContent(content) {
            var contentSection = document.getElementById('contentSection');
            contentSection.innerHTML = content;
        }

        function showPersonnelList(category, stationName) {
            var personnelList = getPersonnelList(category, stationName);
            var content = "<p style='font-size: 1.2em;'><strong>" + category + " at " + stationName + ":</strong></p>" + personnelList;
            updateContent(content);
        }

        function getPersonnelList(category, stationName) {
            var personnelData = JSON.parse(localStorage.getItem('personnelData')) || {};
            var currentDate = new Date().toISOString().split('T')[0];

            if (!personnelData[currentDate]) {
                personnelData[currentDate] = {};
            }

            var personnelList = "<ul>";

            if (personnelData[currentDate][stationName] && personnelData[currentDate][stationName][category]) {
                personnelData[currentDate][stationName][category].forEach(function (person) {
                    personnelList += "<li style='font-size: 1em;'>" + person.name + " - Date: " + person.date +
                        ", Time: " + person.time + " (Last Edited: " + person.lastEdited + ")" +
                        "<br>Details: " + person.details +
                        "<button onclick='editPerson(\"" + currentDate + "\", \"" + stationName + "\", \"" +
                        category + "\", \"" + person.name + "\", \"" + person.time + "\")' style='font-size: 1em;'>Edit</button></li>";
                });
            }

            personnelList += "</ul>";
            localStorage.setItem('personnelData', JSON.stringify(personnelData));

            return personnelList;
        }

        function editPerson(date, station, category, name, time) {
            var newName = prompt("Edit name:", name);
            var newTime = prompt("Edit time:", time);

            if (newName !== null && newTime !== null) {
                var personnelData = JSON.parse(localStorage.getItem('personnelData')) || {};
                personnelData[date] = personnelData[date] || {};
                personnelData[date][station] = personnelData[date][station] || {};
                personnelData[date][station][category] = personnelData[date][station][category] || [];

                personnelData[date][station][category] = personnelData[date][station][category].map(function (person) {
                    if (person.name === name && person.time === time) {
                        person.name = newName;
                        person.time = newTime;
                        person.lastEdited = new Date().toLocaleString();
                    }
                    return person;
                });

                localStorage.setItem('personnelData', JSON.stringify(personnelData));
                showPersonnelList(category, station);
            }
        }

        function openOccurrenceBook() {
            var occurrenceBookModal = document.getElementById('occurrenceBookModal');
            var overlay = document.getElementById('overlay');
            occurrenceBookModal.style.display = 'block';
            overlay.style.display = 'block';
        }

        function saveOccurrenceBook() {
            var occurrenceBookText = document.getElementById('occurrenceBookText').
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fire Station Management</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            color: #333;
            transition: background-color 0.5s;
        }

        header,
        nav,
        footer {
            background: #2C3E50;
            color: white;
            padding: 15px;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            background: #34495E;
            border-bottom: 2px solid #2C3E50;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 10px;
            padding: 12px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-weight: bold;
            letter-spacing: 1px;
            background: #3498DB;
        }

        nav a:hover {
            background-color: #2980B9;
        }

        section {
            margin: 20px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.5s;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 10px;
            padding: 15px;
            background-color: #ECF0F1;
            border-radius: 5px;
            transition: background-color 0.3s;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #BDC3C7;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        li:hover {
            background-color: #D5D8DC;
        }

        button {
            padding: 10px;
            background-color: #3498DB;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980B9;
        }

        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: transform 0.5s;
        }

        .modal input,
        .modal textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #BDC3C7;
            border-radius: 5px;
        }

        .modal button {
            width: 100%;
            padding: 10px;
            background-color: #3498DB;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .modal button:hover {
            background-color: #2980B9;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 900;
            transition: opacity 0.5s;
        }

        footer {
            margin-top: 20px;
            background: #34495E;
            color: white;
            text-align: center;
            padding: 15px;
        }

        @media screen and (max-width: 768px) {
            nav {
                flex-direction: column;
                align-items: flex-start;
            }

            nav a {
                margin: 5px;
            }
        }
    </style>
</head>

<body>

    <header>
        <h1 style="font-size: 2em;">Fire Station Management</h1>
    </header>

    <nav>
        <a href="#" onclick="toggleStationNames()">Station</a>
        <a href="#" onclick="toggleWatchNames()">Watches</a>
        <a href="#" onclick="openDataInputModal()">Appliances Available</a>
        <a href="#" onclick="updatePersonnelOnDuty()">Personnel on Duty</a>
        <a href="#" onclick="openOccurrenceBook()">Occurrence Book</a>
    </nav>

    <section id="contentSection">
        <!-- Dynamic content will be updated here -->
    </section>

    <footer>
        <p>&copy; 2024 Fire Station Management</p>
    </footer>

    <!-- Data Input Modal -->
    <div class="overlay" id="overlay"></div>
    <div class="modal" id="dataInputModal">
        <label for="category">Category:</label>
        <select id="category">
            <option value="Firefighters">Firefighters</option>
            <option value="Paramedics">Paramedics</option>
            <option value="Administrative Staff">Administrative Staff</option>
        </select>
        <label for="name">Name:</label>
        <input type="text" id="name" required>
        <label for="time">Time:</label>
        <input type="text" id="time" required>
        <label for="date">Date:</label>
        <input type="date" id="date" required>
        <textarea id="typingArea" placeholder="Type here..." rows="4" style="resize: none;"></textarea>
        <button onclick="savePersonnelData()">Save</button>
        <button onclick="closeDataInputModal()">Cancel</button>
    </div>

    <!-- Occurrence Book Modal -->
    <div class="modal" id="occurrenceBookModal">
        <h2>Occurrence Book</h2>
        <textarea id="occurrenceBookText" rows="10" cols="50" placeholder="Enter occurrence details..." style="resize: none;"></textarea>
        <br>
        <button onclick="saveOccurrenceBook()">Save</button>
        <button onclick="closeOccurrenceBook()">Close</button>
    </div>

    <script>
        function toggle
