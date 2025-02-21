// Enhanced Company Data
const companies = {
    1: {
        name: "Dire Dawa Textile Factory",
        details: `
            <strong>Location:</strong> Dire Dawa, Ethiopia.<br>
            <strong>Types of Jobs:</strong> Textile engineers, quality assurance specialists, machine operators, factory workers.<br>
            <strong>Required Employees:</strong> 200.<br>
            <strong>Quality of the Company:</strong> Known for producing high-quality fabrics and a safe working environment.<br>
            <strong>Reputation:</strong> One of the leading textile manufacturers in Ethiopia with decades of experience.<br>
            <strong>Benefits:</strong> Free transportation, health insurance, and performance bonuses.<br>
            <strong>Distance from Dire Dawa:</strong> 5 km.
        `,
    },
    2: {
        name: "Dire Dawa Cement Factory",
        details: `
            <strong>Location:</strong> Dire Dawa, Ethiopia.<br>
            <strong>Types of Jobs:</strong> Mechanical engineers, machine operators, safety inspectors, administrative staff.<br>
            <strong>Required Employees:</strong> 150.<br>
            <strong>Quality of the Company:</strong> High-grade cement production and compliance with safety standards.<br>
            <strong>Reputation:</strong> A trusted supplier in the construction industry, locally and regionally.<br>
            <strong>Benefits:</strong> Free housing for workers, pension plans, and on-site training programs.<br>
            <strong>Distance from Dire Dawa:</strong> 10 km.
        `,
    },
    3: {
        name: "Ethio-Djibouti Railway",
        details: `
            <strong>Location:</strong> Dire Dawa, Ethiopia.<br>
            <strong>Types of Jobs:</strong> Railway maintenance workers, logistics managers, ticketing agents, administration staff.<br>
            <strong>Required Employees:</strong> 300.<br>
            <strong>Quality of the Company:</strong> Reliable and efficient transportation services between Ethiopia and Djibouti.<br>
            <strong>Reputation:</strong> A key player in boosting trade between Ethiopia and Djibouti.<br>
            <strong>Benefits:</strong> Travel perks, competitive salaries, and retirement benefits.<br>
            <strong>Distance from Dire Dawa:</strong> 2 km.
        `,
    },
    4: {
        name: "Adama Agricultural Machinery Factory",
        details: `
            <strong>Location:</strong> Adama, Oromia, Ethiopia.<br>
            <strong>Types of Jobs:</strong> Mechanical engineers, assembly line workers, quality controllers, logistics specialists.<br>
            <strong>Required Employees:</strong> 120.<br>
            <strong>Quality of the Company:</strong> Leading producer of agricultural machinery with high durability standards.<br>
            <strong>Reputation:</strong> Known for supporting Ethiopia's agricultural sector with affordable machinery.<br>
            <strong>Benefits:</strong> Subsidized meals, career development programs, and health coverage.<br>
            <strong>Distance from Dire Dawa:</strong> 350 km.
        `,
    },
    5: {
        name: "Oromia Coffee Exporters",
        details: `
            <strong>Location:</strong> Addis Ababa, Ethiopia.<br>
            <strong>Types of Jobs:</strong> Marketing experts, logistics coordinators, coffee graders, export officers.<br>
            <strong>Required Employees:</strong> 50.<br>
            <strong>Quality of the Company:</strong> Consistently exports premium-grade coffee to international markets.<br>
            <strong>Reputation:</strong> A major contributor to Ethiopia’s global coffee presence.<br>
            <strong>Benefits:</strong> Travel opportunities, competitive salaries, and coffee tasting perks.<br>
            <strong>Distance from Dire Dawa:</strong> 450 km.
        `,
    },
    6: {
        name: "Haramaya University",
        details: `
            <strong>Location:</strong> Haramaya, Ethiopia.<br>
            <strong>Types of Jobs:</strong> Professors, researchers, administrative assistants, technical staff.<br>
            <strong>Required Employees:</strong> 200.<br>
            <strong>Quality of the Company:</strong> A highly reputed university fostering academic excellence.<br>
            <strong>Reputation:</strong> Renowned for research and educational leadership in East Africa.<br>
            <strong>Benefits:</strong> On-campus housing, access to university facilities, and professional development opportunities.<br>
            <strong>Distance from Dire Dawa:</strong> 20 km.
        `,
    },
    7: {
        name: "Ethio Telecom - Addis Ababa",
        details: `
            <strong>Location:</strong> Addis Ababa, Ethiopia.<br>
            <strong>Types of Jobs:</strong> IT specialists, customer support, network engineers, sales representatives.<br>
            <strong>Required Employees:</strong> 300.<br>
            <strong>Quality of the Company:</strong> Advanced telecommunications services across Ethiopia.<br>
            <strong>Reputation:</strong> A pioneer in expanding digital connectivity in Ethiopia.<br>
            <strong>Benefits:</strong> Free data allowances, competitive salaries, and employee discounts.<br>
            <strong>Distance from Dire Dawa:</strong> 450 km.
        `,
    },
    8: {
        name: "Commercial Bank of Ethiopia",
        details: `
            <strong>Location:</strong> Nationwide.<br>
            <strong>Types of Jobs:</strong> Bankers, financial analysts, customer service agents, IT staff.<br>
            <strong>Required Employees:</strong> 1,000.<br>
            <strong>Quality of the Company:</strong> Reliable and secure banking services.<br>
            <strong>Reputation:</strong> Ethiopia's largest and most trusted financial institution.<br>
            <strong>Benefits:</strong> Loan privileges, health insurance, and annual bonuses.<br>
            <strong>Distance from Dire Dawa:</strong> Various branches available.
        `,
    },
    9: {
        name: "Awash Bank",
        details: `
            <strong>Location:</strong> Nationwide.<br>
            <strong>Types of Jobs:</strong> Accountants, branch managers, customer service agents, financial consultants.<br>
            <strong>Required Employees:</strong> 500.<br>
            <strong>Quality of the Company:</strong> Innovative and customer-centric banking solutions.<br>
            <strong>Reputation:</strong> Known for its swift services and strong market presence.<br>
            <strong>Benefits:</strong> Pension plans, career advancement, and profit-sharing bonuses.<br>
            <strong>Distance from Dire Dawa:</strong> Various branches available.
        `,
    },
    10: {
        name: "Ethiopian Airlines",
        details: `
            <strong>Location:</strong> Addis Ababa, Ethiopia.<br>
            <strong>Types of Jobs:</strong> Pilots, cabin crew, engineers, logistics officers, customer service staff.<br>
            <strong>Required Employees:</strong> 700.<br>
            <strong>Quality of the Company:</strong> Africa's largest and most successful airline.<br>
            <strong>Reputation:</strong> A leader in aviation excellence, connecting Africa to the world.<br>
            <strong>Benefits:</strong> Travel perks, international training, and comprehensive health insurance.<br>
            <strong>Distance from Dire Dawa:</strong> 450 km.
        `,
    },
};

// DOM Elements
const companySelect = document.getElementById("companySelect");
const companyInfo = document.getElementById("companyInfo");

// Event Listener for Dropdown Change
companySelect.addEventListener("change", function () {
    const selectedValue = companySelect.value;

    if (selectedValue && companies[selectedValue]) {
        const { name, details } = companies[selectedValue];

        companyInfo.style.display = "block";
        companyInfo.innerHTML = `
            <h2>${name}</h2>
            <p>${details}</p>
        `;
    } else {
        companyInfo.style.display = "none";
    }
});
