'use strict';

const puppeteer = require('puppeteer');
const login = process.env.WHMCSMP_LOGIN;
const password = process.env.WHMCSMP_PASSWORD;
const version = process.argv[2];
const changelog = process.argv[3];

const submitForm = async (page, selector, skipWait) => {
    await page.$eval(selector, form => form.submit());
    if (skipWait) {
        return Promise.resolve();
    }
    return page.waitForNavigation({ waitUntil: 'networkidle2' });
};

const waitForSelector = async (page, selector) => {
    const eL = await page.waitForSelector(selector, { timeout: 10000, visible: true });
    await eL.focus(selector);
    return Promise.resolve(eL);
};

(async () => {
    let url = 'https://marketplace.whmcs.com/user/login';
    const browser = await puppeteer.launch({
        headless: true
    });
    const [page] = await browser.pages();
    // page.on('console', msg => console.log('PAGE LOG:', msg.text()));
    await page.setJavaScriptEnabled(true);
    await page.goto(url, { waitUntil: ['load', 'domcontentloaded'], timeout: 10000 });
    // do login
    let selector = '#email';
    await page.type(selector, login);
    selector = '#password';
    await page.type(selector, password);
    await submitForm(page, 'div.login-leftcol form', true);
    await page.waitFor(2000);

    // add new version
    url = 'https://marketplace.whmcs.com/product/4841/versions/new';
    await page.goto(url, { waitUntil: ['load', 'domcontentloaded'], timeout: 10000 });
    selector = '#version';
    await page.type(selector, version);
    selector = '#released_at';
    const date = new Date();
    const day = date.getDate();
    const month = date.getMonth() + 1;
    //tt.mm.jjjj
    //but for any reason we need to provide mm.tt.jjjj when doing it though puppeteer
    await page.type(selector, `${month < 10 ? '0' : ''}${month}.${day < 10 ? '0' : ''}${day}.${date.getFullYear()}`);
    selector = '#description';
    await page.type(selector, changelog);
    await submitForm(page, 'div.listing-edit-container form', true);
    await page.waitFor(2000);

    await page.close();
    await browser.close();
})();
