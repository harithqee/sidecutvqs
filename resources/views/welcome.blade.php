<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidecut Barbershop | Web Prototype</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        barber: { black: '#111827', red: '#ef4444', gray: '#f3f4f6' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-200 font-sans text-gray-800 overflow-hidden">

    <div id="launchpadApp" class="w-full h-screen flex items-center justify-center absolute z-50 bg-gray-200 transition-opacity">
        <div class="bg-white p-10 rounded-2xl shadow-2xl max-w-lg w-full text-center border-t-8 border-barber-black">
            <h1 class="text-3xl font-black mb-2"><i class="fa-solid fa-scissors mr-2"></i> SIDECUT</h1>
            <p class="text-gray-500 mb-8">Select which interface to launch.</p>
            
            <div class="space-y-4">
                <button onclick="launchApp('customerApp')" class="w-full bg-blue-600 text-white p-4 rounded-xl shadow hover:bg-blue-700 flex items-center justify-between transition">
                    <div class="text-left">
                        <span class="block font-bold text-lg">Customer View (Mobile)</span>
                        <span class="text-xs text-blue-200">QR Code landing & live ticket</span>
                    </div>
                    <i class="fa-solid fa-mobile-screen text-2xl"></i>
                </button>
                
                <button onclick="launchApp('barberApp')" class="w-full bg-barber-black text-white p-4 rounded-xl shadow hover:bg-gray-800 flex items-center justify-between transition">
                    <div class="text-left">
                        <span class="block font-bold text-lg">Barber View (Desktop PC)</span>
                        <span class="text-xs text-gray-400">Queue management & Analytics</span>
                    </div>
                    <i class="fa-solid fa-desktop text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="customerApp" class="hidden w-full h-screen flex justify-center items-center bg-gray-300">
        <div class="w-full max-w-md bg-white h-screen sm:h-[800px] sm:rounded-[2rem] sm:border-8 border-gray-900 shadow-2xl relative flex flex-col">
            <header class="bg-barber-black text-white p-4 flex justify-between items-center z-10 sm:rounded-t-2xl">
                <div class="font-bold tracking-wider"><i class="fa-solid fa-scissors mr-2"></i>SIDECUT</div>
                <button onclick="launchApp('launchpadApp')" class="text-gray-300 hover:text-white"><i class="fa-solid fa-home"></i></button>
            </header>

            <div id="custFormView" class="flex-1 flex flex-col p-6 bg-barber-gray overflow-y-auto">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-800 text-center">Customer Registration</h2>
                    <p class="text-xs text-center text-gray-500 mt-1 mb-4">Join the virtual queue</p>
                    <form id="queueForm" onsubmit="joinQueue(event)" class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Full Name</label>
                            <input type="text" id="custName" required class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Enter your name">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Phone (For SMS Alert)</label>
                            <input type="tel" id="custPhone" required class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="01X-XXXXXXX">
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 mt-2 shadow-md">Join Queue</button>
                    </form>
                </div>
            </div>

            <div id="custTicketView" class="hidden flex-1 flex flex-col p-6 items-center bg-barber-gray">
                <div class="w-full bg-white rounded-3xl shadow-lg p-8 border-t-8 border-blue-500 text-center">
                    <h3 class="text-gray-500 font-semibold mb-1">Your Queue Number</h3>
                    <div class="text-6xl font-black text-gray-900 mb-2" id="ticketNumber">#--</div>
                    <p class="text-lg font-bold text-gray-700" id="ticketNameDisplay">Customer Name</p>
                    <hr class="my-6 border-dashed border-gray-200">
                    <div class="grid grid-cols-2 gap-4 text-left mb-6">
                        <div class="bg-blue-50 p-3 rounded-xl">
                            <p class="text-xs text-blue-600 font-bold">EST. WAIT</p>
                            <p class="text-xl font-bold text-gray-800" id="ticketWaitTime">-- Min</p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-xl">
                            <p class="text-xs text-gray-500 font-bold">STATUS</p>
                            <p class="text-xl font-bold text-gray-800" id="ticketStatus">Waiting</p>
                        </div>
                    </div>
                    
                    <div id="susSection" class="hidden mt-6">
                        <h4 class="font-bold text-gray-800 mb-2 text-sm">Service Complete</h4>
                        <button onclick="resetCustomerApp()" class="w-full bg-green-500 text-white font-bold py-3 rounded-lg shadow">Finish & Leave Feedback</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="barberApp" class="hidden w-full h-screen flex bg-gray-100">
        <div class="w-64 bg-barber-black text-white flex flex-col shadow-2xl z-20">
            <div class="p-6 border-b border-gray-800 text-center">
                <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fa-solid fa-scissors text-2xl"></i>
                </div>
                <h2 class="font-bold tracking-widest text-lg">SIDECUT</h2>
                <p class="text-xs text-gray-400">Admin Dashboard</p>
            </div>
            
            <nav class="flex-1 p-4 space-y-2 mt-4">
                <button onclick="switchBarberTab('liveQueue')" id="nav-liveQueue" class="w-full flex items-center p-3 rounded-lg bg-blue-600 font-semibold transition">
                    <i class="fa-solid fa-list-ol w-6 text-center mr-2"></i> Live Queue
                </button>
                <button onclick="switchBarberTab('analytics')" id="nav-analytics" class="w-full flex items-center p-3 rounded-lg hover:bg-gray-800 text-gray-300 font-semibold transition">
                    <i class="fa-solid fa-chart-line w-6 text-center mr-2"></i> Analytics
                </button>
            </nav>
            
            <div class="p-4 border-t border-gray-800">
                <button onclick="launchApp('launchpadApp')" class="w-full flex items-center p-3 text-gray-400 hover:text-white transition">
                    <i class="fa-solid fa-sign-out-alt w-6 text-center mr-2"></i> Exit System
                </button>
            </div>
        </div>

        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            <header class="bg-white shadow-sm px-8 py-4 flex justify-between items-center z-10">
                <h2 id="desktopHeaderTitle" class="text-2xl font-bold text-gray-800">Live Queue Management</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-semibold text-gray-500"><i class="fa-solid fa-user-circle mr-1"></i> Barber 1 (Danial)</span>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8 bg-gray-50">
                <div id="desktopQueueTab" class="block max-w-6xl mx-auto">
                    <div class="flex justify-between items-center mb-6">
                        <div class="bg-white px-6 py-3 rounded-lg shadow-sm border border-gray-200">
                            <span class="text-sm font-bold text-gray-500 uppercase">Customers Waiting: </span>
                            <span class="text-xl font-black text-blue-600 ml-2" id="desktopQueueCount">0</span>
                        </div>
                        <button onclick="simulateCustomerScan()" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-50 text-sm font-bold"><i class="fa-solid fa-plus text-green-500 mr-2"></i>Simulate Walk-in</button>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 text-sm uppercase tracking-wider border-b border-gray-200">
                                    <th class="p-4 font-bold w-24">Ticket #</th>
                                    <th class="p-4 font-bold">Customer Name</th>
                                    <th class="p-4 font-bold">Contact (SMS)</th>
                                    <th class="p-4 font-bold">Status / Wait Time</th>
                                    <th class="p-4 font-bold text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="desktopQueueTableBody" class="divide-y divide-gray-100">
                                </tbody>
                        </table>
                        <div id="emptyQueueState" class="p-10 text-center text-gray-400 hidden">
                            <i class="fa-solid fa-clipboard-check text-4xl mb-3"></i>
                            <p class="font-semibold text-lg">Queue is currently empty.</p>
                            <p class="text-sm">Waiting for customers to scan the QR code.</p>
                        </div>
                    </div>
                </div>

                <div id="desktopAnalyticsTab" class="hidden max-w-6xl mx-auto space-y-6">
                     <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <p class="text-xs text-gray-500 font-bold uppercase mb-1">Total Served Today</p>
                            <p class="text-3xl font-black text-gray-800">42</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <p class="text-xs text-gray-500 font-bold uppercase mb-1">Avg Service Time</p>
                            <p class="text-3xl font-black text-gray-800">18<span class="text-lg text-gray-500 ml-1">min</span></p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <p class="text-xs text-gray-500 font-bold uppercase mb-1">Avg Wait Time</p>
                            <p class="text-3xl font-black text-gray-800">24<span class="text-lg text-gray-500 ml-1">min</span></p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <p class="text-xs text-gray-500 font-bold uppercase mb-1">SMS Alerts Sent</p>
                            <p class="text-3xl font-black text-blue-600">38</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h3 class="text-sm font-bold text-gray-700 mb-4 uppercase">Customer Arrival Distribution</h3>
                            <div class="h-64"><canvas id="pcPeakHoursChart"></canvas></div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex flex-col">
                            <h3 class="text-sm font-bold text-gray-700 mb-4 uppercase">Multi-Channel Utilization (Barbers)</h3>
                            <div class="flex-1 flex flex-col justify-center space-y-8">
                                <div>
                                    <div class="flex justify-between text-sm font-bold text-gray-600 mb-2">
                                        <span>Barber 1 (Danial)</span><span class="text-green-600">Active (78% Utilization)</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-4 border border-gray-200"><div class="bg-blue-500 h-full rounded-full" style="width: 78%"></div></div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm font-bold text-gray-600 mb-2">
                                        <span>Barber 2 (Aiman)</span><span class="text-yellow-600">Active (92% Utilization)</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-4 border border-gray-200"><div class="bg-indigo-500 h-full rounded-full" style="width: 92%"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // --- REAL API INTEGRATION ---
        let chartInitialized = false;
        let currentCustomerId = null; 

        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const view = urlParams.get('view');
            if (view === 'customer') launchApp('customerApp');
            else if (view === 'barber') { launchApp('barberApp'); switchBarberTab('liveQueue'); }
            else document.getElementById('launchpadApp').classList.remove('hidden');
        };
        
        function launchApp(appId) {
            document.getElementById('launchpadApp').classList.add('hidden');
            document.getElementById('customerApp').classList.add('hidden');
            document.getElementById('barberApp').classList.add('hidden');
            document.getElementById(appId).classList.remove('hidden');
            
            if(appId === 'barberApp') renderDesktopQueue();
        }

        // 1. ADD TO QUEUE (POST)
        async function joinQueue(e) {
            e.preventDefault();
            const name = document.getElementById('custName').value;
            const phone = document.getElementById('custPhone').value;
            
            try {
                const res = await fetch('/api/queue', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ name, phone })
                });

                if (!res.ok) throw new Error('Database insertion failed');
                
                const newCustomer = await res.json();
                currentCustomerId = newCustomer.id;

                // Update UI
                document.getElementById('ticketNumber').innerText = newCustomer.qNum;
                document.getElementById('ticketNameDisplay').innerText = newCustomer.name;
                document.getElementById('ticketWaitTime').innerText = `${newCustomer.waitTime} Min`;
                document.getElementById('ticketStatus').innerText = newCustomer.status;
                document.getElementById('ticketStatus').className = "text-xl font-bold text-gray-800"; 
                document.getElementById('susSection').classList.add('hidden');
                
                document.getElementById('custFormView').classList.add('hidden');
                document.getElementById('custTicketView').classList.remove('hidden');
                document.getElementById('queueForm').reset();
                
                // Auto-refresh barber view if open
                renderDesktopQueue();
            } catch (error) {
                console.error(error);
                alert("Error connecting to Laragon DB. Ensure your Laravel server is running.");
            }
        }

        function resetCustomerApp() {
            alert("Feedback submitted. Returning to home screen.");
            document.getElementById('custTicketView').classList.add('hidden');
            document.getElementById('custFormView').classList.remove('hidden');
            launchApp('launchpadApp');
        }

        function switchBarberTab(tab) {
            const queueTab = document.getElementById('desktopQueueTab');
            const analyticsTab = document.getElementById('desktopAnalyticsTab');
            const navQueue = document.getElementById('nav-liveQueue');
            const navAnalytics = document.getElementById('nav-analytics');
            const header = document.getElementById('desktopHeaderTitle');

            if(tab === 'liveQueue') {
                queueTab.classList.remove('hidden'); analyticsTab.classList.add('hidden');
                navQueue.classList.add('bg-blue-600', 'text-white'); navQueue.classList.remove('hover:bg-gray-800', 'text-gray-300');
                navAnalytics.classList.remove('bg-blue-600', 'text-white'); navAnalytics.classList.add('hover:bg-gray-800', 'text-gray-300');
                header.innerText = "Live Queue Management";
                renderDesktopQueue();
            } else {
                queueTab.classList.add('hidden'); analyticsTab.classList.remove('hidden');
                navAnalytics.classList.add('bg-blue-600', 'text-white'); navAnalytics.classList.remove('hover:bg-gray-800', 'text-gray-300');
                navQueue.classList.remove('bg-blue-600', 'text-white'); navQueue.classList.add('hover:bg-gray-800', 'text-gray-300');
                header.innerText = "Operational Analytics";
                if(!chartInitialized) initPCChart();
            }
        }

        // 2. FETCH QUEUE (GET)
        async function renderDesktopQueue() {
            const tbody = document.getElementById('desktopQueueTableBody');
            const emptyState = document.getElementById('emptyQueueState');
            
            try {
                const res = await fetch('/api/queue', {
                    headers: { 'Accept': 'application/json' }
                });
                const currentQueue = res.ok ? await res.json() : [];

                document.getElementById('desktopQueueCount').innerText = currentQueue.length;
                tbody.innerHTML = '';

                if(currentQueue.length === 0) {
                    emptyState.classList.remove('hidden');
                    return;
                } else {
                    emptyState.classList.add('hidden');
                }

                currentQueue.forEach((cust, index) => {
                    const isNext = index === 0;
                    const tr = document.createElement('tr');
                    tr.className = `border-b border-gray-100 hover:bg-gray-50 transition-colors ${isNext ? 'bg-yellow-50/50' : 'bg-white'}`;
                    
                    tr.innerHTML = `
                        <td class="p-4 font-bold text-gray-800 text-lg">${cust.qNum}</td>
                        <td class="p-4 font-semibold text-gray-700">${cust.name}</td>
                        <td class="p-4 text-gray-600"><i class="fa-solid fa-phone text-xs text-gray-400 mr-2"></i>${cust.phone}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold ${isNext ? 'bg-yellow-100 text-yellow-700 border border-yellow-200' : 'bg-gray-100 text-gray-600 border border-gray-200'}">
                                ${isNext ? 'Next Up' : 'Waiting (~' + cust.waitTime + 'm)'}
                            </span>
                        </td>
                        <td class="p-4 text-right space-x-2">
                            ${isNext ? `<button onclick="sendDesktopSMS(${cust.id})" class="bg-barber-black text-white px-4 py-2 rounded-md text-sm font-bold hover:bg-gray-800 transition shadow-sm"><i class="fa-solid fa-paper-plane mr-2"></i>SMS Alert</button>` : ''}
                            <button onclick="completeDesktopService(${cust.id})" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-bold hover:bg-green-500 hover:text-white hover:border-green-500 transition shadow-sm"><i class="fa-solid fa-check mr-2"></i>Complete</button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        }

        // 3. UPDATE STATUS (PATCH)
        async function sendDesktopSMS(id) {
            try {
                await fetch(`/api/queue/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ status: 'Turn Approaching!' })
                });
                
                alert('Database updated: Status set to "Turn Approaching!"');
                
                if(currentCustomerId === id) {
                    const custUIStatus = document.getElementById('ticketStatus');
                    if(custUIStatus) {
                        custUIStatus.innerText = 'Turn Approaching!';
                        custUIStatus.className = "text-xl font-bold text-yellow-500";
                    }
                }
                renderDesktopQueue();
            } catch (error) {
                console.error("Error updating status:", error);
            }
        }

        // 4. DELETE FROM QUEUE (DELETE)
        async function completeDesktopService(id) {
            try {
                await fetch(`/api/queue/${id}`, { 
                    method: 'DELETE',
                    headers: { 'Accept': 'application/json' }
                });
                
                renderDesktopQueue();
                
                if(currentCustomerId === id) {
                    const custUIStatus = document.getElementById('ticketStatus');
                    if(custUIStatus) {
                        custUIStatus.innerText = 'Service Complete';
                        custUIStatus.className = "text-xl font-bold text-green-500";
                        document.getElementById('susSection').classList.remove('hidden');
                    }
                }
            } catch (error) {
                console.error("Error deleting record:", error);
            }
        }

        async function simulateCustomerScan() {
            const names = ["Danial Hafiq", "Aisya", "Anis", "Aina"];
            const randomName = names[Math.floor(Math.random() * names.length)];
            const phone = `01${Math.floor(Math.random() * 90000000) + 10000000}`;
            
            try {
                await fetch('/api/queue', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ name: randomName, phone })
                });
                renderDesktopQueue();
            } catch (error) {
                console.error("Error generating dummy record:", error);
            }
        }

        // Chart.js initialization
        function initPCChart() {
            const ctx = document.getElementById('pcPeakHoursChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['10am', '12pm', '2pm', '4pm', '6pm', '8pm'],
                    datasets: [{
                        label: 'Customers Walk-ins',
                        data: [4, 15, 8, 20, 35, 12],
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        borderWidth: 3, fill: true, tension: 0.4, pointBackgroundColor: '#111827', pointRadius: 4
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, grid: { color: '#f3f4f6' } }, x: { grid: { display: false } } }
                }
            });
            chartInitialized = true;
        }
    </script>
</body>
</html>