const {CEKDPT} = require('./dpt.js');
const express = require("express");
const app = express();
const port = 10001;
const dpt = new CEKDPT();
dpt.init();


app.get("/", (req, res) => {
    res.json({ message: "OK" });
}
);

app.get("/getdatatps/:nik", async (req, res) => {
    const nik = req.params.nik;
    let data = await dpt.getDataTps(nik);
    res.json(data);
});

app.get("/dpt", async (req, res) => {
    // nik
    const nik = req.query.nik;
    // get data
    let data = await dpt.getDataTps(nik);
    res.json(data);
});

app.listen(port, () => {
    console.log(`Example app listening at http://localhost:${port}`);
});

// (async () => {
//     // init
//     const dpt = new CEKDPT();
//     await dpt.init();
//     // get data
//     let data = await dpt.getDataTps("3509123110900002");
//     console.log(data);
//     // close
//     // await dpt.close();
// })();