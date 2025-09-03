from playwright.sync_api import sync_playwright
import time

def run(playwright):
    browser = playwright.chromium.launch(headless=True)
    context = browser.new_context()
    page = context.new_page()

    # Go to login page
    page.goto("http://127.0.0.1:8006/login")
    page.wait_for_load_state("networkidle")

    # Fill in login form
    page.locator('input[name="email"]').fill("testuser@example.com")
    page.locator('input[name="password"]').fill("password")

    # Click login button
    page.get_by_role("button", name="Login").click()
    page.wait_for_load_state("networkidle")


    # Go to user dashboard
    page.goto("http://127.0.0.1:8006/dashboard/user")
    page.wait_for_load_state("networkidle")

    # Get the href of the first store link and navigate to it
    store_url = page.locator('.bg-blue-500').first.get_attribute("href")
    page.goto(f"http://127.0.0.1:8006{store_url}")
    page.wait_for_load_state("networkidle")

    # Take screenshot
    page.screenshot(path="jules-scratch/verification/themed_products.png")

    browser.close()

with sync_playwright() as playwright:
    run(playwright)
