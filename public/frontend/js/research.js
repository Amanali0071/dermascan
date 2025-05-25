// Predefined research papers (replace with API/database in production)
const researchPapers = [
    {
        title: "Advancements in Teledermatology",
        summary: "This 2023 study examines how teledermatology enhances patient access to care, reducing diagnostic delays by 40% in underserved regions. Published in the *Journal of Dermatological Science*.",
        link: "https://example.com/teledermatology"
    },
    {
        title: "AI-Powered Dermatology Diagnostics",
        summary: "A peer-reviewed paper exploring AI algorithms achieving 95% accuracy in identifying melanoma, with implications for scalable screening solutions.",
        link: "https://example.com/ai-dermatology"
    },
    {
        title: "Non-Invasive Skin Cancer Detection",
        summary: "An in-depth analysis of optical coherence tomography (OCT) for early skin cancer detection, reducing biopsy rates by 30%. Published in *Nature Dermatology*.",
        link: "https://example.com/skin-cancer-detection"
    },
    {
        title: "Environmental Impact on Skin Health",
        summary: "Research on how pollution and UV radiation exacerbate chronic skin conditions like eczema and psoriasis, conducted with UC Berkeley.",
        link: "https://example.com/environmental-impact"
    },
    {
        title: "Teledermatology in Rural Communities",
        summary: "A 2-year study showing a 25% increase in early diagnosis rates through teledermatology outreach, published in *The Lancet*.",
        link: "https://example.com/rural-teledermatology"
    }
];

// Search functionality
document.getElementById('searchButton').addEventListener('click', function() {
    const searchTerm = document.getElementById('searchInput').value.trim().toLowerCase();
    const results = researchPapers.filter(paper => 
        paper.title.toLowerCase().includes(searchTerm) || 
        paper.summary.toLowerCase().includes(searchTerm)
    );
    displayResults(results);
});

// Display search results
function displayResults(results) {
    const resultsDiv = document.getElementById('searchResults');
    resultsDiv.innerHTML = '';

    if (results.length === 0) {
        resultsDiv.innerHTML = '<p>No results found. Try different keywords.</p>';
        return;
    }

    results.forEach(paper => {
        const paperDiv = document.createElement('div');
        paperDiv.innerHTML = `
            <h3>${paper.title}</h3>
            <p>${paper.summary}</p>
            <a href="${paper.link}" target="_blank">Read Full Study</a>
        `;
        resultsDiv.appendChild(paperDiv);
    });
}

// Enable search on Enter key press
document.getElementById('searchInput').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        document.getElementById('searchButton').click();
    }
});