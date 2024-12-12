import { Builder, By, until } from "selenium-webdriver";
import * as chrome from "selenium-webdriver/chrome.js";

let options = new chrome.Options();

(async function laravelTest() {
const driver = new Builder()
.forBrowser("chrome")
.setChromeOptions(options)
.build();

try {
console.log("Iniciando o teste...");
const loginUrl = "http://127.0.0.1:8000/login";
await driver.get(loginUrl);
console.log("Página de login carregada.");

const cpf_nif = await driver.findElement(By.name("cpf_nif"));
await cpf_nif.sendKeys("10928102910");

const senha = await driver.findElement(By.name("senha"));
await senha.sendKeys("12345");

const loginButton = await driver.findElement(
By.css("button[type='submit']")
);
await loginButton.click();
console.log("Botão de login clicado.");

// Espera a URL mudar
try {
await driver.wait(
until.urlIs("http://127.0.0.1:8000/dashboard/professor"),
20000
);
console.log("Concluído com êxito: Redirecionado para o dashboard.");
} catch (urlError) {
console.error(
"Erro: URL esperada não carregada. Verifique o redirecionamento."
);
console.log("URL atual:", await driver.getCurrentUrl());
}
} catch (err) {
console.error("Erro ao executar o teste:", err.message || err);
} finally {
await driver.quit();
console.log("Navegador fechado.");
}
})();
