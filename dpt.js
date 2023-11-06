const puppeteer = require('puppeteer-extra');
const pluginStealth = require('puppeteer-extra-plugin-stealth')();
puppeteer.use(pluginStealth)
const fs = require("fs");

class DPT {
    // constructor
    constructor() {
        this.browser = null;
        this.pid_browser = null;
        this.page = null;
    }
    async spleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    // init browser
    async init() {
        this.browser = await puppeteer.launch({
            headless: 'new',
            // headless: false,
            args: [
                '--disable-gpu',
                '--disable-dev-shm-usage',
                '--disable-setuid-sandbox',
                '--no-first-run',
                '--no-sandbox',
                '--mute-audio'
                // '--no-zygote',
                // '--single-process',
                // '--disable-web-security'
            ]
        });

        // pid
        this.pid_browser = this.browser.process().pid;
        // Open a new page
        const pages = await this.browser.pages();
        this.page = pages[0];
        await this.page.goto("https://cekdptonline.kpu.go.id/", {
            waitUntil: "domcontentloaded",
        });
 
        // on disconnected reopen
        this.browser.on('disconnected', async () => {
            console.log("disconnected");
            await this.init();
        });
    }

    // getDataTps
    async getDataTps(nik) {
        try {
            let inputnik = await this.page.waitForSelector("#__BVID__19");
            if (!inputnik) {
                return {status: false, nik,message: "Class update, silahkan hub developer", data: {}};
            }
            // erorr jika nik tidak sama dengan 16 digit
            if (nik.length != 16) {
                return {status: false, nik,message: "NIK harus 16 digit", data: {}};
            }
            await this.page.type("#__BVID__19", nik);
            // tekan enter
            await this.page.keyboard.press('Enter');
            // wait post resonse json
            // tangkap network request dari https://cekdptonline.kpu.go.id/apilhp
            let data = null;
            await this.page.waitForResponse(response => {
                if (response.url().includes("apilhp")) {
                    data = response.json();
                    return true;
                }
            });
            
            // kebali ke halaman awal => /html/body/div[1]/div/main/div[4]/div/div/div/div/div/div[2]/button
            const [button2] = await this.page.$x("/html/body/div[1]/div/main/div[4]/div/div/div/div/div/div[2]/button");
            if (button2) {
                await button2.click();
            }
            // reload page
            await this.page.reload();
            // parse data
            let result = await data;
            console.log('result', result);
            if (result.data?.findNikSidalih) {
                // ambil lhp
                let payload = result?.data?.findNikSidalih;
                // update payload nik dengan nik yang diinput
                payload.nik = nik;
                // hapus lhp
                delete payload.lhp;
                return {status:true, nik, data: payload};
            } else {
                return {status:false, nik,message: "Data tidak ditemukan", data: {} };
            }
        } catch (error) {
            console.log('error', error);
            // close browser and reopen
            await this.browser.close();
            await this.init();
            return { status: false, nik,message: error.message, data: {  } };
        }
    }
}

module.exports = { CEKDPT: DPT }