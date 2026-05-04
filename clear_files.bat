@echo off
cd /d C:\xampp\htdocs\UX_Pacific
for %%F in (ui-ux-design-agency-in-*.php) do (
    type nul > "%%F"
)
echo Done
