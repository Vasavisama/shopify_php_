from playwright.sync_api import sync_playwright
import time

def run(playwright):
    browser = playwright.chromium.launch(headless=True)
    context = browser.new_context()
    page = context.new_page()

    # Go to login page
    page.goto("http://127.0.0.1:8004/login")
    page.wait_for_load_state("networkidle")

    # Fill in login form
    page.locator('input[name="email"]').fill("testuser@example.com")
    page.locator('input[name="password"]').fill("password")

    # Click login button
    page.get_by_role("button", name="Login").click()
    page.wait_for_load_state("networkidle")


    # Go to user dashboard
    page.goto("http://127.0.0.1:8004/dashboard/user")
    page.wait_for_load_state("networkidle")


    # Take screenshot
    page.screenshot(path="jules-scratch/verification/user_dashboard.png")

    browser.close()

with sync_playwright() as playwright:
    run(playwright)
