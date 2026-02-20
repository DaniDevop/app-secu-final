<style>

/* ===== RESET ===== */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Segoe UI', sans-serif;
}

body{
    display:flex;
    min-height:100vh;
    background:linear-gradient(135deg,#f1f3f5,#dee2e6);
}


.logout{
    font-size:13px;
    opacity:0.7;
    text-align:center;
}

/* ===== MAIN ===== */
.main{
    flex:1;
    padding:30px 40px;
}

/* ===== HEADER ===== */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.header h1{
    font-size:22px;
    color:#1B4332;
}

.user-info{
    background:white;
    padding:10px 18px;
    border-radius:30px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
    font-weight:600;
}

/* ===== CARDS ===== */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
    margin-top:40px;
}

.card{
    background:white;
    padding:25px;
    border-radius:15px;
    position:relative;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 20px 40px rgba(0,0,0,0.15);
}

.card::before{
    content:'';
    position:absolute;
    width:5px;
    height:100%;
    background:#D4AF37;
    left:0;
    top:0;
}

.card h3{
    color:#1B4332;
    font-size:15px;
    margin-bottom:15px;
}

.card p{
    font-size:32px;
    font-weight:bold;
    color:#081C15;
}

/* ===== SECTION TABLE ===== */
.section{
    margin-top:50px;
}

.section h2{
    margin-bottom:20px;
    color:#1B4332;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
}

thead{
    background:#1B4332;
    color:white;
}

th, td{
    padding:15px;
    text-align:left;
}

tbody tr{
    border-bottom:1px solid #e9ecef;
    transition:0.2s;
}

tbody tr:hover{
    background:#f8f9fa;
}

.status{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
}

.en-cours{
    background:#d4edda;
    color:#155724;
}

.termine{
    background:#e2e3e5;
    color:#383d41;
}

.attente{
    background:#fff3cd;
    color:#856404;
}

/* ===== RESPONSIVE ===== */
@media(max-width:900px){
    .sidebar{
        display:none;
    }
    body{
        flex-direction:column;
    }
}

</style>