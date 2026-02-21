# Payroll Management System - Complete Documentation

## Project Overview

This is a comprehensive **Payroll and HR Management System** built using **CodeIgniter 3** framework. The system manages employee records, salary processing, statutory compliance (PF, ESI, Professional Tax), contractor management, and various HR operations for manufacturing/industrial environments, specifically focused on bidi (tobacco) manufacturing operations.

### Technology Stack

- **Framework**: CodeIgniter 3.x (PHP MVC Framework)
- **Database**: MySQL (Database: `dineshzk_payroll`)
- **Frontend**: Bootstrap 3.x, jQuery, DataTables
- **PDF Generation**: FPDF Library
- **Excel Operations**: PHPExcel/Excel library
- **Server**: Apache (with mod_rewrite enabled)
- **Session Management**: File-based sessions (7200 seconds expiration)

### Application URL Structure

- **Base URL**: `http://localhost/payroll/` (Development)
- **Production URL**: `https://dineshbidi.com/payroll/`
- **Default Controller**: Payroll (Login page)

---

## System Architecture

### MVC Pattern Implementation

```
project-root/
├── application/
│   ├── controllers/     # Business logic controllers
│   ├── models/          # Database interaction layer
│   ├── views/           # UI templates
│   ├── config/          # Configuration files
│   ├── libraries/       # Custom libraries (PDF, Excel)
│   ├── logs/            # Application logs
│   └── cache/           # Cache storage
├── system/              # CodeIgniter core files
├── assets/              # Static resources (CSS, JS, images)
├── uploads/             # User uploaded files
└── index.php            # Application entry point
```


## Core Modules & Features

### 1. Authentication & User Management

**Controller**: `Usermanagement.php`  
**Model**: `Usermanagementmodel.php`  
**Views**: `login.php`, `userManagement.php`

**Features**:
- Multi-company login system
- Role-based access control (RBAC)
- User creation, update, and deletion
- Menu and submenu access management
- Session-based authentication (2-hour timeout)

**Login Flow**:
1. User enters User ID, Password, and selects Company
2. System validates credentials against `user_management` table
3. On success, creates session with user details and company context
4. Redirects to dashboard with role-based menu access
5. Session checked on every page load via `header.php`

**Access Control Levels**:
- Menu Level (8 main menus)
- Submenu Level (granular permissions per menu item)
- Stored in `roll_management` table

---

### 2. Company Management

**Controller**: `Companycontroller.php`  
**Model**: `Companymodel.php`  
**View**: `company.php`

**Features**:
- Multi-company support
- Company master data management
- Establishment ID tracking
- PF/ESI registration details
- Company-specific configurations

**Database Table**: `company_master`

**Key Fields**:
- `company_id` (Primary Key)
- `estb_id` (Establishment ID)
- Company name, address, contact details
- PF/ESI registration numbers
- Active status

---

### 3. Employee Management

**Controller**: `Employee.php`  
**Model**: `Employeemodel.php`  
**Views**: `employee.php`, `kycupdate.php`, `employeemissingdata.php`

**Features**:
- Complete employee lifecycle management
- Personal information (Name, DOB, DOJ, Gender, etc.)
- UAN (Universal Account Number) tracking
- Aadhaar integration
- Father/Husband name with relation
- Contact details (Mobile, Email)
- Nationality and qualification
- Marital status
- International worker tracking
- Passport details
- Physical handicap information
- Employee type classification
- Contractor assignment
- Address linking
- Profile image upload
- PMRPY (Pradhan Mantri Rojgar Protsahan Yojana) eligibility

**Database Table**: `employee_master`

**Employee Types**:
- Regular employees
- Contractor-based employees
- Office staff
- Bidi rollers
- Packers

**Related Modules**:
- KYC Management (`kyc_master`)
- Family Details (`family_master`)
- Nominee Details (`nominee_master`)


**Employee Operations**:
- Add new employee
- Update employee details
- Delete employee
- Search by various criteria
- Export employee data
- Import employee data (bulk upload)
- Image upload for employee profiles
- Missing data identification
- Email address updates
- Mobile number validation

---

### 4. Contractor Management

**Controller**: `Contractorcontroller.php`  
**Model**: `Contractormodel.php`  
**View**: `contractor.php`

**Features**:
- Contractor master data
- Contractor code management
- License details
- Contact information
- Employee assignment to contractors

**Database Table**: `contractor_master`

**Key Fields**:
- `contractor_id`
- `ccode` (Contractor Code)
- Contractor name
- License number
- Contact details
- Active status

---

### 5. Address Management

**Controller**: `Addresscontroller.php`  
**Model**: `Addressmodel.php`  
**View**: `address.php`

**Features**:
- Centralized address repository
- Address linking to employees
- Multiple address types support

**Database Table**: `address_master`

---

### 6. Wages & Salary Processing

#### 6.1 Bidi Roller Wages

**Controller**: `Bidirollewages.php`  
**Model**: `Bidirollewagesmodel.php`  
**Views**: `bidirollewages.php`, `bidiRoller.php`

**Features**:
- Production-based wage calculation
- Daily/monthly wage entry
- Attendance tracking
- Piece-rate calculations
- Wage rate master setup

**Database Tables**:
- `bidiroller_wages` (Wage rates)
- `bidi_roller_entry` (Daily entries)

**Calculation Logic**:
- Based on production quantity
- Rate per unit (bidi sticks/bundles)
- Attendance-based calculations
- Deductions (PF, ESI, PT, Advance)

#### 6.2 Packing Wages

**Controller**: `Packingwages.php`  
**Model**: `Packingwagesmodel.php`  
**Views**: `packingwages.php`, `packers.php`

**Features**:
- Packer wage management
- Production tracking
- Rate master setup
- Daily entry system

**Database Tables**:
- `packing_wages` (Wage rates)
- `packers_entry` (Daily entries)

#### 6.3 Office Staff Salary

**Controller**: `Officestaffsalary.php`  
**Model**: `Officestaffsalarymodel.php`  
**Views**: `officestaffsalary.php`, `officeStaff.php`

**Features**:
- Fixed salary management
- Monthly salary processing
- Allowances and deductions
- Salary structure setup

**Database Tables**:
- `office_staff_salary` (Salary structure)
- `office_staff_entry` (Monthly entries)


---

### 7. Salary Sheet Generation

#### 7.1 Office Salary Sheet

**Controller**: `Officesalarysheet.php`  
**Model**: `Officesalarysheetmodel.php`  
**View**: `officeSalarySheet.php`

**Features**:
- Monthly salary sheet generation
- Earnings breakdown
- Deductions calculation
- Net salary computation
- PDF export

#### 7.2 Packer Salary Sheet

**Controller**: `Packersalarysheet.php`  
**Model**: `Packersalarysheetmodel.php`  
**View**: `packingsalarysheet.php`

**Features**:
- Production-based salary calculation
- Attendance integration
- Deductions processing
- PDF generation

#### 7.3 Contractor Salary Sheet

**Controller**: `Contractorsheet.php`  
**Model**: `Contractorsheetmodel.php`  
**View**: `contractorSalarySheet.php`

**Features**:
- Contractor-wise salary consolidation
- Employee grouping by contractor
- Statutory compliance calculations
- Payment summary

---

### 8. Statutory Compliance & Reports

#### 8.1 PF (Provident Fund) Management

**Controllers**: 
- `Pfchallanyearly.php` - Yearly challan
- `Pfsummary.php` - PF summary reports

**Models**: 
- `Pfchallanyearlymodel.php`
- `Pfsummarymodel.php`

**Views**: 
- `pfchallanyearly.php`
- `pfsummary.php`
- `pfchallan.php`

**Features**:
- Monthly PF calculation (12% employee + 12% employer)
- PF challan generation
- Yearly PF summary
- ECR (Electronic Challan cum Return) report
- Form 2, 3A, 5, 10, 11 generation
- PF claim form processing

**PF Forms**:
- **Form 2**: Declaration and nomination form
- **Form 3A**: Contribution card
- **Form 5**: Consolidated statement
- **Form 10**: Scheme certificate
- **Form 11**: Declaration form

#### 8.2 ECR Report

**Controller**: `Ecrreport.php`  
**Model**: `Ecrreportmodel.php`  
**View**: `ecrreport.php`

**Features**:
- Electronic Challan cum Return generation
- EPFO compliance
- Monthly contribution details
- CSV/Excel export for EPFO portal upload

#### 8.3 PMRPY Report

**Controller**: `Pmrpyreport.php`  
**Model**: `Pmrpyreportmodel.php`  
**View**: `pmrpyreport.php`

**Features**:
- Pradhan Mantri Rojgar Protsahan Yojana reporting
- Eligible employee tracking
- Government subsidy calculations

#### 8.4 Professional Tax

**Controller**: `Professionaltax.php`  
**Model**: `Professionaltaxmodel.php`  
**Views**: `professionaltax.php`, `monthWiseProfessionalTax.php`

**Features**:
- State-wise PT slab management
- Monthly PT deduction
- PT challan generation
- Month-wise PT reports

**Database Table**: `professional_tax`


#### 8.5 Payment Advice

**Controller**: `Paymentadvicereport.php`  
**Model**: `Paymentadvicereportmodel.php`  
**View**: `paymentadvice.php`

**Features**:
- Bank payment advice generation
- Employee-wise payment details
- Bank account information
- Payment summary

#### 8.6 Bonus Sheet

**Controller**: `Bonussheet.php`  
**Model**: `Bonussheetmodel.php`  
**View**: `bonussheet.php`

**Features**:
- Annual bonus calculation
- Payment on Wages Act compliance
- Bonus eligibility tracking
- Bonus distribution reports

#### 8.7 Gratuity Calculation

**View**: `gratuityreport.php`

**Features**:
- Gratuity calculation (15 days salary for each year)
- Service period tracking
- Gratuity eligibility (5 years minimum)
- Payment processing

**Database Table**: `gratuity_master`

---

### 9. Attendance & Calendar Management

#### 9.1 Calendar Management

**Controller**: `Calendercontroller.php`  
**Model**: `Calendermodel.php`  
**View**: `calender.php`

**Features**:
- Holiday master setup
- Weekly off configuration
- Festival holidays
- National holidays
- Company-specific holidays

**Database Table**: `calender_master`

**Holiday Types**:
- Weekly Off
- National Holiday
- Festival Holiday
- Company Holiday

#### 9.2 Attendance Printing

**Controller**: `Attandanceprinting.php`  
**Model**: `Attandanceprintingmodel.php`  
**Views**: `attendanceSheetPrinting.php`, `attendanceprintingpdf.php`

**Features**:
- Monthly attendance sheet generation
- Present/Absent/Leave marking
- Attendance register printing
- PDF export for records

---

### 10. Challan Management

**Controller**: `Challansetup.php`  
**Model**: `Challansetupmodel.php`  
**Views**: `challan_setup.php`, `challanDate.php`

**Features**:
- PF challan setup
- ESI challan setup
- Challan date management
- TRRN (Transaction Reference Number) tracking
- Payment due dates
- Challan generation for statutory payments

**Database Tables**:
- `challan_setup`
- `challan_date_entry`

---

### 11. Resignation Management

**Controller**: `Resignation.php`  
**Model**: `Resignationmodel.php`  
**View**: `resignation.php`

**Features**:
- Employee resignation processing
- Resignation date tracking
- Final settlement calculations
- Exit formalities
- Employee status update

**Database Table**: `resignation_master`

**Settlement Components**:
- Pending salary
- Leave encashment
- Gratuity (if eligible)
- PF withdrawal
- Notice period recovery


---

### 12. Reports & Analytics

**Controller**: `Reportcontroller.php`  
**Model**: `Reportmodel.php`

**Available Reports**:

1. **3 Month Absent List**
   - View: `3monthabsentlist.php`
   - Tracks employees absent for 3+ months
   - Helps identify inactive employees

2. **58 Years of Age Report**
   - View: `58yearsofage.php`
   - Lists employees nearing retirement
   - Retirement planning

3. **Month Absent List**
   - Controller: `Monthabsentlist.php`
   - Model: `Monthabsentlistmodel.php`
   - View: `3monthabsentlist.php`
   - Monthly absenteeism tracking

4. **Employee Data Export**
   - View: `employeeDataExport.php`
   - Bulk employee data export
   - Excel/CSV format

5. **KYC Export**
   - View: `kycExport.php`
   - KYC details export
   - Compliance documentation

6. **Missing Data Report**
   - View: `employeemissingdata.php`
   - Identifies incomplete employee records
   - Data quality management

---

### 13. Data Import/Export

#### 13.1 Employee Import

**Controller**: `Employeeimport.php`  
**Model**: `Employeeimportmodel.php`  
**View**: `employeeDataImport.php`

**Features**:
- Bulk employee data upload
- Excel file import
- Data validation
- Error reporting
- Duplicate checking

#### 13.2 Gratuity Import

**View**: `gratuityDataImport.php`

**Features**:
- Gratuity data bulk upload
- Historical data migration

#### 13.3 Excel to Text Conversion

**View**: `ExceltoText.php`

**Features**:
- Excel file processing
- Text format conversion
- Data transformation

---

### 14. Utility Features

#### 14.1 Notes Management

**Controller**: `Notescontroller.php`  
**Model**: `Notesmodel.php`  
**View**: `notes.php`

**Features**:
- Internal notes/reminders
- Date-wise note tracking
- Important announcements
- Task reminders

**Database Table**: `notes_master`

#### 14.2 Database Backup & Restore

**Views**: `dbbackup.php`, `dbrestore.php`

**Features**:
- Database backup creation
- Scheduled backups
- Backup restoration
- Data recovery

#### 14.3 Delete Month Entry

**View**: `deleteMonthEntry.php`

**Features**:
- Remove incorrect monthly entries
- Data correction
- Bulk deletion by month

#### 14.4 Label Printing

**View**: `label.php`

**Features**:
- Employee ID card printing
- Label generation
- Barcode/QR code support


---

## Database Schema

### Core Tables

#### 1. user_management
```sql
- id (PK)
- user_name
- user_id
- password
- company_id
- status
- created_date
```

#### 2. roll_management
```sql
- id (PK)
- user_id (FK)
- menu (Menu ID: 1-8)
- access (Comma-separated submenu codes)
```

#### 3. company_master
```sql
- company_id (PK)
- estb_id
- company_name
- address
- pf_number
- esi_number
- contact_details
- status
```

#### 4. employee_master
```sql
- emp_id (PK)
- UAN
- member_id
- member_id_org
- name_as_aadhaar
- dob
- doj
- gender
- father_husband
- relation
- mobile
- email
- aadhaar_no
- nationality
- qualification
- marital_status
- international_worker
- country_origin
- passport_no
- passport_from_date
- passport_till_date
- physical_handicap
- locomotive
- visual
- hearing
- employee_type
- contractor
- address_id
- emp_image
- pmrpy
- status
```

#### 5. contractor_master
```sql
- contractor_id (PK)
- ccode
- contractor_name
- license_no
- contact_person
- mobile
- email
- address
- status
```

#### 6. address_master
```sql
- id (PK)
- address
- city
- state
- pincode
- status
```

#### 7. kyc_master
```sql
- id (PK)
- emp_id (FK)
- bank_name
- branch_name
- account_no
- ifsc_code
- pan_no
- driving_license
- voter_id
- ration_card
- other_documents
```

#### 8. family_master
```sql
- family_id (PK)
- emp_id (FK)
- name
- relation
- dob
- dependent
```

#### 9. nominee_master
```sql
- nomi_id (PK)
- emp_id (FK)
- nominee_name
- relation
- dob
- address
- share_percentage
```


### Wages & Salary Tables

#### 10. bidiroller_wages
```sql
- id (PK)
- from_date
- to_date
- rate_per_thousand
- basic_rate
- da_rate
- hra_rate
- status
```

#### 11. bidi_roller_entry
```sql
- bidi_roller_entry_id (PK)
- UAN (FK)
- entry_date
- production_qty
- wages
- pf_deduction
- esi_deduction
- pt_deduction
- advance
- net_wages
- status
```

#### 12. packing_wages
```sql
- id (PK)
- from_date
- to_date
- rate_per_unit
- basic_rate
- status
```

#### 13. packers_entry
```sql
- packers_entry_id (PK)
- uan (FK)
- entry_date
- production_qty
- gross_wages
- pf_deduction
- esi_deduction
- pt_deduction
- advance
- net_wages
- status
```

#### 14. office_staff_salary
```sql
- id (PK)
- from_date
- to_date
- basic_salary
- da
- hra
- conveyance
- medical
- other_allowance
- status
```

#### 15. office_staff_entry
```sql
- id (PK)
- uan (FK)
- month
- year
- basic
- da
- hra
- gross_salary
- pf_deduction
- esi_deduction
- pt_deduction
- tds
- advance
- other_deduction
- net_salary
- status
```

### Statutory Compliance Tables

#### 16. professional_tax
```sql
- id (PK)
- from_date
- to_date
- salary_from
- salary_to
- pt_amount
- status
```

#### 17. challan_setup
```sql
- challan_id (PK)
- from_date
- to_date
- pf_rate_employee
- pf_rate_employer
- esi_rate_employee
- esi_rate_employer
- status
```

#### 18. challan_date_entry
```sql
- challan_date_id (PK)
- ttrn
- month
- year
- challan_date
- payment_date
- amount
- challan_type (PF/ESI)
- status
```

#### 19. gratuity_master
```sql
- gratuity_id (PK)
- member_id (FK)
- doj
- dol (Date of Leaving)
- service_years
- last_drawn_salary
- gratuity_amount
- payment_date
- status
```

#### 20. resignation_master
```sql
- resignation_id (PK)
- member_id (FK)
- resignation_date
- last_working_date
- reason
- final_settlement_amount
- settlement_date
- status
```


### Utility Tables

#### 21. calender_master
```sql
- id (PK)
- holiday_type
- holiday_date
- holiday_name
- description
- company_id (FK)
- status
```

#### 22. notes_master
```sql
- id (PK)
- note_date
- note_title
- note_description
- created_by
- status
```

---

## Application Flow

### 1. User Authentication Flow

```
User Access → Login Page (payroll/index)
    ↓
Enter Credentials (User ID, Password, Company)
    ↓
Validate against user_management table
    ↓
Check roll_management for access rights
    ↓
Create Session (userid, username, company_id, access_rights)
    ↓
Redirect to Dashboard (payroll/dashboard)
    ↓
Load Menu based on Role
```

### 2. Employee Onboarding Flow

```
Add Employee → Employee Master Entry
    ↓
Personal Details (Name, DOB, DOJ, Aadhaar, UAN)
    ↓
Contact Details (Mobile, Email, Address)
    ↓
Employment Details (Type, Contractor, Department)
    ↓
Upload Photo
    ↓
Save to employee_master
    ↓
Add KYC Details (Bank, PAN, etc.)
    ↓
Add Family Details
    ↓
Add Nominee Details
    ↓
Employee Active
```

### 3. Monthly Salary Processing Flow

```
Month Start
    ↓
Daily Attendance/Production Entry
    ↓ (For Production Workers)
Bidi Roller Entry / Packer Entry
    ↓ (For Office Staff)
Office Staff Attendance
    ↓
Month End
    ↓
Generate Salary Sheets
    ↓
Calculate Gross Wages/Salary
    ↓
Apply Deductions (PF, ESI, PT, Advance)
    ↓
Calculate Net Salary
    ↓
Generate Reports (Salary Sheet, Payment Advice)
    ↓
Process Statutory Payments (PF, ESI, PT Challans)
    ↓
Generate ECR Report
    ↓
Bank Payment Processing
```

### 4. Statutory Compliance Flow

```
Monthly Salary Processing Complete
    ↓
Calculate PF Contribution (Employee 12% + Employer 12%)
    ↓
Calculate ESI Contribution (Employee 0.75% + Employer 3.25%)
    ↓
Calculate Professional Tax (Slab-based)
    ↓
Generate PF Challan
    ↓
Generate ESI Challan
    ↓
Generate ECR Report (CSV for EPFO portal)
    ↓
Generate Payment Advice
    ↓
Update Challan Date Entry (TRRN, Payment Date)
    ↓
Generate Yearly PF Summary
    ↓
Generate Form 2, 3A, 5, 10, 11 (as needed)
```


### 5. Resignation & Exit Flow

```
Employee Submits Resignation
    ↓
Enter Resignation Details (Date, Reason)
    ↓
Calculate Notice Period
    ↓
Calculate Final Settlement:
    - Pending Salary
    - Leave Encashment
    - Gratuity (if 5+ years service)
    - Bonus (if applicable)
    - Less: Advance/Loans
    - Less: Notice Period Recovery
    ↓
Generate Final Settlement Sheet
    ↓
Process PF Withdrawal (Form 19/10C)
    ↓
Update Employee Status to Inactive
    ↓
Generate Exit Documents
    ↓
Final Payment
```

---

## Menu Structure & Access Control

### Main Menus (8 Levels)

#### Menu 1: Dashboard
- Dashboard view
- Quick statistics
- Pending tasks

#### Menu 2: Master Data (m_0 to m_4)
- **m_0**: Company Master
- **m_1**: Employee Master
- **m_2**: Contractor Master
- **m_3**: Address Master
- **m_4**: Calendar Master

#### Menu 3: Salary Setup (s_0 to s_4)
- **s_0**: Bidi Roller Wages Setup
- **s_1**: Packing Wages Setup
- **s_2**: Office Staff Salary Setup
- **s_3**: Professional Tax Setup
- **s_4**: Challan Setup

#### Menu 4: Entry Screens (e_0 to e_4)
- **e_0**: Bidi Roller Entry
- **e_1**: Packer Entry
- **e_2**: Office Staff Entry
- **e_3**: Challan Date Entry
- **e_4**: Resignation Entry

#### Menu 5: Reports (r_0 to r_10)
- **r_0**: Office Salary Sheet
- **r_1**: Packing Salary Sheet
- **r_2**: Contractor Salary Sheet
- **r_3**: PF Challan
- **r_4**: PF Summary
- **r_5**: ECR Report
- **r_6**: PMRPY Report
- **r_7**: Payment Advice
- **r_8**: Bonus Sheet
- **r_9**: Gratuity Report
- **r_10**: Professional Tax Report

#### Menu 6: Utilities (u_0 to u_9)
- **u_0**: Employee Data Import
- **u_1**: Employee Data Export
- **u_2**: KYC Export
- **u_3**: Attendance Printing
- **u_4**: Missing Data Report
- **u_5**: Delete Month Entry
- **u_6**: Database Backup
- **u_7**: Database Restore
- **u_8**: 3 Month Absent List
- **u_9**: 58 Years Age Report

#### Menu 7: Tools (t_0 to t_2)
- **t_0**: Notes Management
- **t_1**: Excel to Text
- **t_2**: Label Printing

#### Menu 8: Configuration (c_0)
- **c_0**: User Management

---

## Key Business Rules

### 1. PF (Provident Fund) Rules
- Applicable on salary up to ₹15,000 (wage ceiling)
- Employee contribution: 12% of basic + DA
- Employer contribution: 12% (3.67% to EPF, 8.33% to EPS)
- EPS contribution capped at ₹1,250 (on ₹15,000)
- Mandatory for establishments with 20+ employees

### 2. ESI (Employee State Insurance) Rules
- Applicable on salary up to ₹21,000
- Employee contribution: 0.75% of gross salary
- Employer contribution: 3.25% of gross salary
- Mandatory for establishments with 10+ employees

### 3. Professional Tax Rules
- State-specific slab rates
- Monthly deduction based on gross salary
- Maximum ₹2,500 per year in most states
- Deducted from employee salary

### 4. Gratuity Rules
- Eligibility: 5 years of continuous service
- Calculation: (Last drawn salary × 15 days × Years of service) / 26
- Maximum: ₹20,00,000 (as per Payment of Gratuity Act)
- Payable on retirement, resignation, death, or disability

### 5. Bonus Rules
- Eligibility: Salary up to ₹21,000 per month
- Minimum: 8.33% of salary or ₹100 (whichever is higher)
- Maximum: 20% of salary
- Payable annually (usually during festivals)


### 6. Wage Calculation Rules

#### Bidi Roller Wages
- Production-based payment
- Rate per 1000 bidi sticks
- Attendance mandatory for payment
- Deductions: PF + ESI + PT + Advance
- Net Wages = Gross Wages - Total Deductions

#### Packer Wages
- Production-based payment
- Rate per unit/package
- Daily entry system
- Similar deduction structure

#### Office Staff Salary
- Fixed monthly salary
- Components: Basic + DA + HRA + Allowances
- Deductions: PF + ESI + PT + TDS + Advance
- Net Salary = Gross Salary - Total Deductions

---

## File Upload & Storage

### Upload Directories

```
uploads/
├── employee/           # Employee profile images
├── documents/          # KYC documents
└── temp/              # Temporary uploads

assets/images/
└── employee/
    └── profile/       # Employee photos
```

### Supported File Types
- **Images**: JPG, JPEG, PNG, GIF
- **Documents**: PDF, DOC, DOCX
- **Data Files**: XLS, XLSX, CSV

### File Size Limits
- Profile Images: 10 MB
- Documents: 30 MB
- Bulk Import Files: 50 MB

---

## PDF Generation

### FPDF Library Usage

**Location**: `application/libraries/`

**Custom Libraries**:
1. **Pdf.php** - Basic PDF generation
2. **Fpdf_gen.php** - General purpose PDF
3. **Exfpdfpdf.php** - Extended FPDF
4. **Easytablefpdf.php** - Table-based PDF

**Generated PDFs**:
- Salary sheets
- Attendance registers
- PF challans
- Payment advice
- Bonus sheets
- Form 2, 3A, 5, 10, 11
- Employee reports

### PDF Features
- Company letterhead
- Auto page numbering
- Table formatting
- Multi-page support
- Landscape/Portrait orientation
- Custom fonts
- Watermarks

---

## Excel Operations

### PHPExcel Library

**Location**: `application/libraries/Excel.php`

**Operations**:
1. **Import**:
   - Employee bulk upload
   - Gratuity data import
   - Attendance import
   - Wage data import

2. **Export**:
   - Employee master data
   - KYC details
   - Salary sheets
   - ECR reports
   - Payment advice

### Excel Templates
- Employee import template
- Attendance template
- Wage entry template

---

## AJAX Operations

### Key AJAX Endpoints

**Employee Module**:
- `Employee/save_employee` - Save/Update employee
- `Employee/show_employee` - Fetch employee list
- `Employee/delete_employee` - Delete employee
- `Employee/save_kyc_detail` - Save KYC details
- `Employee/save_nominee_detail` - Save nominee
- `Employee/save_family_detail` - Save family details
- `Employee/uploadImage` - Upload profile image

**User Management**:
- `Usermanagement/save_usermanagement` - Save user
- `Usermanagement/view_usermanagement` - View users
- `Usermanagement/delete_usermanagement` - Delete user
- `Usermanagement/edit_usermanagement` - Edit user

**Company Module**:
- `Companycontroller/save_company` - Save company
- `Companycontroller/show_company` - Show companies

**Contractor Module**:
- `Contractorcontroller/save_contractor` - Save contractor
- `Contractorcontroller/show_contractor` - Show contractors

**All AJAX responses return JSON format**


---

## Security Features

### 1. Authentication
- Session-based authentication
- Password encryption (recommended to use bcrypt/password_hash)
- Session timeout: 2 hours (7200 seconds)
- Auto logout on inactivity

### 2. Authorization
- Role-based access control (RBAC)
- Menu-level permissions
- Submenu-level permissions
- Page-level access checks

### 3. Input Validation
- XSS filtering (currently disabled - should be enabled)
- CSRF protection (currently disabled - should be enabled)
- SQL injection prevention via CodeIgniter Query Builder
- File upload validation

### 4. Session Security
- Session regeneration every 5 minutes
- Session data stored in files
- IP matching disabled (can be enabled)

### 5. Database Security
- Prepared statements via CodeIgniter
- No direct SQL queries (uses Query Builder)
- Database credentials in config file

### 6. File Security
- .htaccess protection on sensitive directories
- File type validation on uploads
- File size restrictions

---

## Configuration Files

### 1. config.php
```php
$config['base_url'] = 'http://localhost/payroll/';
$config['index_page'] = '';  // mod_rewrite enabled
$config['uri_protocol'] = 'REQUEST_URI';
$config['encryption_key'] = '';  // Should be set
$config['sess_driver'] = 'files';
$config['sess_expiration'] = 7200;
$config['csrf_protection'] = FALSE;  // Should be TRUE
```

### 2. database.php
```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'dineshzk_payroll',
    'dbdriver' => 'mysqli',
);
```

### 3. routes.php
```php
$route['default_controller'] = 'payroll';
$route['404_override'] = '';
```

### 4. autoload.php
```php
$autoload['libraries'] = array('database', 'session');
$autoload['helper'] = array('url');
```

---

## Frontend Technologies

### CSS Frameworks
- Bootstrap 3.x
- Font Awesome icons
- Simple Line Icons
- Custom app.css

### JavaScript Libraries
- jQuery 2.x/3.x
- DataTables (table management)
- Bootstrap JS
- jQuery Validation
- jQuery UI
- Select2 (dropdown enhancement)
- Bootstrap DateTimePicker
- Chart.js (for dashboards)
- Flot Charts
- Morris.js
- FullCalendar
- SweetAlert (alerts)
- jQuery Steps (wizards)
- X-editable (inline editing)

### UI Components
- Responsive tables
- Modal dialogs
- Date pickers
- Dropdown selects
- File upload widgets
- Toast notifications
- Progress bars
- Wizards/Multi-step forms

---

## API Endpoints Summary

### Authentication
- `POST /payroll/login` - User login
- `GET /payroll/logout` - User logout

### Employee Management
- `POST /Employee/save_employee` - Create/Update employee
- `GET /Employee/show_employee` - List employees
- `POST /Employee/delete_employee` - Delete employee
- `POST /Employee/uploadImage` - Upload profile image
- `POST /Employee/save_kyc_detail` - Save KYC
- `POST /Employee/save_nominee_detail` - Save nominee
- `POST /Employee/save_family_detail` - Save family

### Company Management
- `POST /Companycontroller/save_company` - Save company
- `GET /Companycontroller/show_company` - List companies

### Contractor Management
- `POST /Contractorcontroller/save_contractor` - Save contractor
- `GET /Contractorcontroller/show_contractor` - List contractors

### Wages & Salary
- `POST /Bidirollewages/save_wages` - Save bidi roller wages
- `POST /Packingwages/save_wages` - Save packing wages
- `POST /Officestaffsalary/save_salary` - Save office salary

### Reports
- `GET /Officesalarysheet/generate` - Office salary sheet
- `GET /Packersalarysheet/generate` - Packer salary sheet
- `GET /Contractorsheet/generate` - Contractor salary sheet
- `GET /Ecrreport/generate` - ECR report
- `GET /Pmrpyreport/generate` - PMRPY report
- `GET /Paymentadvicereport/generate` - Payment advice


---

## Deployment Guide

### Server Requirements
- PHP 7.0 or higher
- MySQL 5.6 or higher
- Apache with mod_rewrite enabled
- PHP Extensions:
  - mysqli
  - gd (for image processing)
  - mbstring
  - zip
  - xml

### Installation Steps

1. **Upload Files**
   ```
   Upload all files to server root or subdirectory
   ```

2. **Database Setup**
   ```sql
   CREATE DATABASE dineshzk_payroll;
   Import payroll_app_backup-on-2018-07-07-05-23-40.sql
   ```

3. **Configure Database**
   ```php
   Edit: application/config/database.php
   Set: hostname, username, password, database
   ```

4. **Configure Base URL**
   ```php
   Edit: application/config/config.php
   Set: $config['base_url'] = 'https://yourdomain.com/payroll/';
   ```

5. **Set Permissions**
   ```bash
   chmod 755 application/cache
   chmod 755 application/logs
   chmod 755 uploads
   chmod 755 assets/images/employee
   ```

6. **Configure .htaccess**
   ```apache
   RewriteEngine On
   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteCond %{REQUEST_FILENAME} !-d
   RewriteRule ^(.*)$ index.php/$1 [L]
   ```

7. **Security Hardening**
   ```php
   // In config.php
   $config['encryption_key'] = 'your-random-32-character-key';
   $config['csrf_protection'] = TRUE;
   $config['global_xss_filtering'] = TRUE;
   
   // Change default passwords
   // Update database credentials
   ```

8. **Test Installation**
   ```
   Access: https://yourdomain.com/payroll/
   Login with default credentials
   Change default password immediately
   ```

---

## Maintenance & Troubleshooting

### Common Issues

#### 1. 404 Errors on Pages
**Solution**: Check mod_rewrite is enabled
```apache
# Enable in Apache config
LoadModule rewrite_module modules/mod_rewrite.so

# Check .htaccess exists in root
```

#### 2. Database Connection Error
**Solution**: Verify database credentials
```php
// Check application/config/database.php
// Test MySQL connection manually
```

#### 3. Session Issues
**Solution**: Check session directory permissions
```bash
chmod 755 application/cache
# Or set custom session path
```

#### 4. Upload Failures
**Solution**: Check upload directory permissions
```bash
chmod 755 uploads
chmod 755 assets/images/employee/profile
```

#### 5. PDF Generation Errors
**Solution**: Check FPDF library and font files
```php
// Verify: application/libraries/Pdf.php exists
// Check: assets/fpdf/font/ directory
```

### Logs Location
```
application/logs/log-YYYY-MM-DD.php
```

### Backup Strategy
1. **Database Backup**: Daily automated backup
2. **File Backup**: Weekly full backup
3. **Retention**: 30 days minimum

### Performance Optimization
1. Enable query caching
2. Use database indexing
3. Optimize images
4. Enable Gzip compression
5. Use CDN for static assets
6. Implement Redis/Memcached for sessions

---

## Future Enhancements

### Recommended Improvements

1. **Security**
   - Enable CSRF protection
   - Implement password hashing (bcrypt)
   - Add two-factor authentication
   - Implement API rate limiting
   - Add audit logging

2. **Features**
   - Mobile app integration
   - Biometric attendance
   - Employee self-service portal
   - Leave management system
   - Loan management
   - Performance appraisal module
   - Training management
   - Asset management

3. **Technical**
   - Upgrade to CodeIgniter 4
   - Implement REST API
   - Add unit tests
   - Implement CI/CD pipeline
   - Add Docker support
   - Implement microservices architecture

4. **Reporting**
   - Advanced analytics dashboard
   - Custom report builder
   - Data visualization
   - Export to multiple formats
   - Scheduled report emails

5. **Integration**
   - Bank payment gateway
   - SMS notifications
   - Email notifications
   - Aadhaar verification API
   - EPFO API integration
   - Payroll software integration


---

## Developer Guide

### Code Structure Best Practices

#### Controller Pattern
```php
class Employee extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Employeemodel');
    }
    
    function save_employee() {
        $id = $this->input->post('id');
        if($id == "add") {
            $data = $this->Employeemodel->employee_save();
        } else {
            $data = $this->Employeemodel->employee_update();
        }
        echo json_encode($data);
    }
}
```

#### Model Pattern
```php
class Employeemodel extends CI_Model {
    function employee_save() {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email')
        );
        $this->db->insert('employee_master', $data);
        return $this->db->insert_id();
    }
}
```

#### View Pattern
```php
<?php $this->load->view('header'); ?>
<div class="content">
    <!-- Page content -->
</div>
<?php $this->load->view('footer'); ?>
```

### Database Query Examples

#### Insert
```php
$data = array('field' => 'value');
$this->db->insert('table_name', $data);
```

#### Update
```php
$data = array('field' => 'value');
$this->db->where('id', $id);
$this->db->update('table_name', $data);
```

#### Select
```php
$this->db->select('*');
$this->db->from('table_name');
$this->db->where('status', 1);
$query = $this->db->get();
return $query->result();
```

#### Join
```php
$this->db->select('e.*, c.company_name');
$this->db->from('employee_master e');
$this->db->join('company_master c', 'e.company_id = c.company_id');
$query = $this->db->get();
```

### AJAX Request Example

```javascript
$.ajax({
    url: base_url + 'Employee/save_employee',
    type: 'POST',
    data: {
        id: 'add',
        name: $('#name').val(),
        email: $('#email').val()
    },
    dataType: 'json',
    success: function(response) {
        if(response.success) {
            alert('Employee saved successfully');
        }
    },
    error: function() {
        alert('Error occurred');
    }
});
```

### PDF Generation Example

```php
$this->load->library('pdf');
$this->pdf->AddPage();
$this->pdf->SetFont('Arial', 'B', 16);
$this->pdf->Cell(0, 10, 'Salary Sheet', 0, 1, 'C');
$this->pdf->Output('salary_sheet.pdf', 'D');
```

---

## Testing Guide

### Manual Testing Checklist

#### Authentication
- [ ] Login with valid credentials
- [ ] Login with invalid credentials
- [ ] Session timeout after 2 hours
- [ ] Logout functionality
- [ ] Multi-company selection

#### Employee Management
- [ ] Add new employee
- [ ] Update employee details
- [ ] Delete employee
- [ ] Upload employee image
- [ ] Add KYC details
- [ ] Add family details
- [ ] Add nominee details
- [ ] Search employee
- [ ] Export employee data
- [ ] Import employee data

#### Salary Processing
- [ ] Enter daily wages
- [ ] Calculate gross wages
- [ ] Apply deductions
- [ ] Generate salary sheet
- [ ] Verify calculations
- [ ] Export to PDF
- [ ] Export to Excel

#### Statutory Compliance
- [ ] Generate PF challan
- [ ] Generate ESI challan
- [ ] Generate ECR report
- [ ] Generate PMRPY report
- [ ] Verify PF calculations
- [ ] Verify ESI calculations
- [ ] Generate Form 2, 3A, 5, 10, 11

#### Reports
- [ ] Office salary sheet
- [ ] Packer salary sheet
- [ ] Contractor salary sheet
- [ ] Payment advice
- [ ] Bonus sheet
- [ ] Gratuity report
- [ ] Absent list reports

---

## Support & Documentation

### Internal Documentation
- Code comments in controllers and models
- Database schema documentation
- API endpoint documentation

### External Resources
- CodeIgniter 3 Documentation: https://codeigniter.com/userguide3/
- Bootstrap 3 Documentation: https://getbootstrap.com/docs/3.4/
- FPDF Documentation: http://www.fpdf.org/

### Contact Information
- **Project**: Payroll Management System
- **Framework**: CodeIgniter 3
- **Database**: MySQL
- **Domain**: dineshbidi.com

---

## Glossary

**UAN**: Universal Account Number - Unique PF number for employees  
**EPFO**: Employees' Provident Fund Organisation  
**ESI**: Employee State Insurance  
**ECR**: Electronic Challan cum Return  
**PMRPY**: Pradhan Mantri Rojgar Protsahan Yojana  
**PT**: Professional Tax  
**TRRN**: Transaction Reference Number  
**DA**: Dearness Allowance  
**HRA**: House Rent Allowance  
**PF**: Provident Fund  
**EPS**: Employee Pension Scheme  
**EPF**: Employee Provident Fund  
**KYC**: Know Your Customer  
**IFSC**: Indian Financial System Code  
**PAN**: Permanent Account Number  
**TDS**: Tax Deducted at Source  

---

## Version History

**Current Version**: 1.0 (Based on 2018-07-07 backup)

**Key Milestones**:
- Initial development: 2018
- Database backup: July 7, 2018
- Multiple updates to wage calculation models (2020, 2023)
- Ongoing maintenance and enhancements

---

## Conclusion

This Payroll Management System is a comprehensive solution for managing employee records, processing salaries, and ensuring statutory compliance for manufacturing/industrial organizations, particularly in the bidi manufacturing sector. The system handles complex wage calculations, multiple employee types, contractor management, and generates all necessary statutory reports and forms required by Indian labor laws.

The modular architecture allows for easy maintenance and future enhancements, while the role-based access control ensures data security and proper authorization at all levels.

---

**Document Generated**: February 9, 2026  
**System Analysis**: Complete Project Structure  
**Documentation Type**: Technical & Functional Specification
