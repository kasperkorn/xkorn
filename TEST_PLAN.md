# Floodgate Monitoring System - Test Plan

## 1. Environment Setup (Prerequisites for Testing)
- Deployed Laravel application.
- Running MySQL database server accessible to the application.
- Database migrated with the `floodgates` table.
- Optional: Sample data populated in the `floodgates` table.
- API testing tool (e.g., Postman, curl).
- Web browser with developer tools for UI testing.

## 2. API Testing (Endpoint: `PUT /api/floodgates/{id}`)
Replace `{id}` with a valid 5-digit floodgate ID from your test data.
Default Headers: `Accept: application/json`, `Content-Type: application/json`

| Test Case ID | Description                                      | Method | URL Segment         | Body (JSON)                                                                 | Expected Status Code | Expected Response Body (Key elements)                                  |
|--------------|--------------------------------------------------|--------|---------------------|-----------------------------------------------------------------------------|----------------------|------------------------------------------------------------------------|
| API-001      | Update existing floodgate with valid data        | PUT    | `/api/floodgates/00001` | `{"water_flow_rate": 10.5, "status": "open", "pump_status": "open"}`      | 200                  | Updated floodgate data, e.g., `"id": "00001", "status": "open"`         |
| API-002      | Invalid `status` value                           | PUT    | `/api/floodgates/00001` | `{"water_flow_rate": 10.5, "status": "invalid", "pump_status": "open"}`   | 422                  | Validation error message for `status`                                  |
| API-003      | Missing `water_flow_rate`                        | PUT    | `/api/floodgates/00001` | `{"status": "close", "pump_status": "close"}`                             | 422                  | Validation error message for `water_flow_rate`                       |
| API-004      | Non-numeric `water_flow_rate`                    | PUT    | `/api/floodgates/00001` | `{"water_flow_rate": "abc", "status": "open", "pump_status": "open"}`     | 422                  | Validation error message for `water_flow_rate`                       |
| API-005      | Update non-existent floodgate ID                 | PUT    | `/api/floodgates/99999` | `{"water_flow_rate": 10.5, "status": "open", "pump_status": "open"}`      | 404                  | Error message like "Floodgate not found"                               |
| API-006      | Valid data, `pump_status` changed to 'close'     | PUT    | `/api/floodgates/00001` | `{"water_flow_rate": 12.0, "status": "open", "pump_status": "close"}`     | 200                  | Updated floodgate data, e.g., `"pump_status": "close"`                 |

## 3. UI Testing (Web Application)

### 3.1. General Checks (All Pages/Sections)
| Test Case ID | Description                                   | Steps                                                                 | Expected Result                                                                    |
|--------------|-----------------------------------------------|-----------------------------------------------------------------------|------------------------------------------------------------------------------------|
| UI-GEN-001   | Page Title                                    | Open the application.                                                 | Browser tab title is "Homepage - Smart Flood Management" or similar.               |
| UI-GEN-002   | Footer                                        | Scroll to the bottom of the page.                                     | Footer "Developed by :: Korn" is visible.                                          |
| UI-GEN-003   | "Prompt" Font                                 | Inspect text elements.                                                | Font family is "Prompt".                                                           |
| UI-GEN-004   | Main sections present                         | Load the page.                                                        | Search, List, and Dashboard sections are visible with their respective titles.     |

### 3.2. Header and Navigation
| Test Case ID | Description                                   | Steps                                                                 | Expected Result                                                                    |
|--------------|-----------------------------------------------|-----------------------------------------------------------------------|------------------------------------------------------------------------------------|
| UI-NAV-001   | Logo and System Name                          | Observe the header.                                                   | Logo (placeholder or actual) and "Smart Flood Management Systems 2025" are visible. |
| UI-NAV-002   | Smooth Scroll to Search                       | Click "Search" navigation link.                                       | Page smoothly scrolls to the "Floodgate Search" section.                           |
| UI-NAV-003   | Smooth Scroll to Dashboard                    | Click "Statistics Dashboard" navigation link.                         | Page smoothly scrolls to the "Statistics Dashboard" section.                       |

### 3.3. Floodgate Search Section
(Assume some floodgates like '10001', '10002' exist, and '99999' does not)
| Test Case ID | Description                                   | Steps                                                                 | Expected Result                                                                    |
|--------------|-----------------------------------------------|-----------------------------------------------------------------------|------------------------------------------------------------------------------------|
| UI-SRC-001   | Search for existing floodgate                 | Enter '10001' in ID field, click Search.                              | Table appears below form showing details for floodgate '10001'.                    |
| UI-SRC-002   | Search for non-existing floodgate             | Enter '99999' in ID field, click Search.                              | Message "Floodgate with ID '99999' not found." is displayed.                     |
| UI-SRC-003   | Search with invalid ID (too short)            | Enter '123' in ID field, click Search.                                | Validation error message for ID field (e.g., "must be 5 digits").                |
| UI-SRC-004   | Search with invalid ID (non-numeric)          | Enter 'abcde' in ID field, click Search.                              | Validation error message for ID field.                                             |
| UI-SRC-005   | Search form retains input                     | Enter '12345', click Search.                                          | '12345' remains in the input field.                                                |

### 3.4. Floodgate List Section
(Populate with at least 5-10 floodgates for good testing, some open, some closed)
| Test Case ID | Description                                   | Steps                                                                 | Expected Result                                                                    |
|--------------|-----------------------------------------------|-----------------------------------------------------------------------|------------------------------------------------------------------------------------|
| UI-LST-001   | List display                                  | Load the page.                                                        | Table shows floodgates with columns: No., ID, Location, Water Flow Rate, Status, Pump Status. |
| UI-LST-002   | No data message (if DB is empty)              | Ensure `floodgates` table is empty, load page.                      | Message "No floodgate data available." is shown.                                   |
| UI-LST-003   | Pagination (if >15 gates)                     | Add >15 floodgates, load page.                                        | Pagination links appear. Clicking page numbers/next loads new data.                |

### 3.5. Statistics Dashboard Section
| Test Case ID | Description                                   | Steps                                                                 | Expected Result                                                                    |
|--------------|-----------------------------------------------|-----------------------------------------------------------------------|------------------------------------------------------------------------------------|
| UI-DSH-001   | Statistics display                            | Load page (with some floodgate data: e.g., 3 total, 1 open, 2 closed, 1 pump on, 2 pumps off). | Cards display: Total Gates: 3, Gates Open: 1, Gates Closed: 2, Pumps Active: 1, Pumps Inactive: 2. |
| UI-DSH-002   | Statistics with no data (if DB is empty)      | Ensure `floodgates` table is empty, load page.                      | All statistics show 0.                                                             |

### 3.6. Responsiveness Testing (Test on various screen widths: Desktop, Tablet, Mobile)
| Test Case ID | Description                                   | Steps                                                                 | Expected Result                                                                    |
|--------------|-----------------------------------------------|-----------------------------------------------------------------------|------------------------------------------------------------------------------------|
| UI-RES-001   | Header Navigation (Mobile)                    | Reduce screen width to mobile size.                                   | Nav links stack vertically. Header content is readable.                            |
| UI-RES-002   | Search Form (Mobile)                          | Reduce screen width.                                                  | Search input and button are usable, possibly stacked or full-width.                |
| UI-RES-003   | Floodgate List Table (Mobile)                 | Reduce screen width.                                                  | Table is horizontally scrollable if content exceeds width.                         |
| UI-RES-004   | Dashboard Cards (Mobile)                      | Reduce screen width.                                                  | Statistic cards stack vertically and are readable.                                 |
| UI-RES-005   | General Layout (All sizes)                    | Resize browser window through various widths.                         | No major layout breaks, overlaps, or unreadable text. Content remains accessible. |
