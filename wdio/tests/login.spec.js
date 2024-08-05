// @ts-check
const { test, expect } = require('@playwright/test');
async function  login(page){
  await page.goto('http://sistem-manajemen-stok.test/login')

    await page.getByLabel('Email').fill('admin@gmail.com')
    await page.getByLabel('Password').fill('admin')
    await page.getByText('LOG IN' ).click()

    await expect(page).toHaveURL('http://sistem-manajemen-stok.test/dashboard')
}
test.describe('Test User Action', async () => {
  test('login dengan kredesnisal benar', async ({ page }) => {
    await page.goto('http://sistem-manajemen-stok.test/login')

    await page.getByLabel('Email').fill('admin@gmail.com')
    await page.getByLabel('Password').fill('admin')
    await page.getByText('LOG IN' ).click()

    await expect(page).toHaveURL('http://sistem-manajemen-stok.test/dashboard')
  });

  test('generate AI advice', async ({ page }) => {
    await login(page)
    await page.goto('http://sistem-manajemen-stok.test/dashboard')
    await page.locator('xpath=/html/body/div[2]/main/div/div/div/div[1]/div[1]/div/div[1]/div/a').click();
    await expect(page).toHaveURL('http://sistem-manajemen-stok.test/dashboard')
  })

  test('Membuat produk', async ({ page }) => {
    // await login(page)
    // // masuk ke menu database
    // await page.goto('http://sistem-manajemen-stok.test/database')
    // // klik tambah
    // await page.locator('xpath=/html/body/div[2]/main/div[1]/div/div/div/div[1]/div/div[1]/div/div[2]/button').click();
    // // isi form
    // await page.locator('xpath=//*[@id="nama_bahan"]').fill('test bahan')
    // await page.locator('xpath=//*[@id="stok_bahan"]').fill('20')
    // await page.locator('xpath=//*[@id="satuan_bahan"]').fill('Kg')
    // await page.locator('xpath=//*[@id="modalAddBahanBaku"]/div/div/form/div[2]/button[2]').click()
    
  })

  test('Menghapus produk', async ({ page }) => {
  })
  test('Menambah bahan', async ({ page }) => {})
  test('Menghapus bahan', async ({ page }) => {})
  test('Membuat Transaksi Bahan', async ({ page }) => {})
  test('Membuat Transaksi Produk', async ({ page }) => {})


})
