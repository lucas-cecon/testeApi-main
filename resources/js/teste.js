import { Builder, By, until } from "selenium-webdriver";
import * as chrome from "selenium-webdriver/chrome.js";

let options = new chrome.Options();

(async function laravelTest() {
    const driver = new Builder()
        .forBrowser("chrome")
        .setChromeOptions(options)
        .build();

    try {
        // Passo 1: Navegar até a página de login
        const loginUrl = "http://127.0.0.1:8000/login"; // Substitua pela URL do login
        await driver.get(loginUrl);

        // Passo 2: Preencher os campos de login
        const cpf_nif = await driver.findElement(By.name("cpf_nif"));
        await cpf_nif.sendKeys("09876543210");

        const senha = await driver.findElement(By.name("senha"));
        await senha.sendKeys("12345");

        // Passo 3: Submeter o formulário
        const loginButton = await driver.findElement(
            By.css("button[type='submit']")
        );
        await loginButton.click();

        // Passo 4: Aguarde até que a página pós-login carregue
        await driver.wait(until.urlIs("http://127.0.0.1:8000/dashboard"));
        
    } catch (err) {
        console.error("Erro ao executar o teste:", err);
    } finally {
        // Finalizar o navegador
        await driver.quit();
    }
})();