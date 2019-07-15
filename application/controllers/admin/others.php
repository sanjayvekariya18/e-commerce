<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Others extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('download');

        if (!$this->common->logged_in()) {
            header('location:' . site_url());
        } else if (!$this->common->getPermission($this->session->userdata('primary_email'))->others) {
            header('location:' . site_url() . 'admin');
        }
        $this->load->model('admin/m_others', 'others');
    }

    function allDelivered() {
        $data['orders'] = $this->others->getAllDelivered();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/allorders/delivered', $data);
        $this->load->view('admin/footer');
    }

    function allReturn() {
        $data['orders'] = $this->others->getAllReturn();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/allorders/return', $data);
        $this->load->view('admin/footer');
    }

    function allShippedCancel() {
        $data['orders'] = $this->others->getAllShippedCancel();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/allorders/shippedcancel', $data);
        $this->load->view('admin/footer');
    }

    function allCancel() {
        $data['orders'] = $this->others->getAllCancel();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/allorders/cancel', $data);
        $this->load->view('admin/footer');
    }

    function allShipped() {
        $data['orders'] = $this->others->getAllShipped();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/allorders/shipped', $data);
        $this->load->view('admin/footer');
    }

    function allRefund() {
        $data['orders'] = $this->others->getAllRefund();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/allorders/refund', $data);
        $this->load->view('admin/footer');
    }
    
    // Fedex Orders Functions

    function allFedex() {
        $data['orders'] = $this->others->getAllFedex();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/fedexorders/all', $data);
        $this->load->view('admin/footer');
    }

    function fedexShipped() {
        $data['orders'] = $this->others->getFedexShipped();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/fedexorders/shipped', $data);
        $this->load->view('admin/footer');
    }

    function fedexCancel() {
        $data['orders'] = $this->others->getFedexCancel();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/fedexorders/cancel', $data);
        $this->load->view('admin/footer');
    }

    function fedexShippedCancel() {
        $data['orders'] = $this->others->getFedexShippedCancel();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/fedexorders/shippedcancel', $data);
        $this->load->view('admin/footer');
    }

    function fedexDelivered() {
        $data['orders'] = $this->others->getFedexDelivered();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/fedexorders/delivered', $data);
        $this->load->view('admin/footer');
    }

    function fedexReturn() {
        $data['orders'] = $this->others->getFedexReturn();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/fedexorders/return', $data);
        $this->load->view('admin/footer');
    }

    function fedexRefund() {
        $data['orders'] = $this->others->getFedexRefund();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/fedexorders/refund', $data);
        $this->load->view('admin/footer');
    }

    function fedexCod() {
        $data['orders'] = $this->others->getFedexCod();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/fedexorders/cod', $data);
        $this->load->view('admin/footer');
    }

    function fedexCard() {
        $data['orders'] = $this->others->getFedexCard();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/fedexorders/card', $data);
        $this->load->view('admin/footer');
    }
    
    // Indiapost Orders Functions

    function allIndiapost() {
        $data['orders'] = $this->others->getAllIndiaPost();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/indiapostorders/all', $data);
        $this->load->view('admin/footer');
    }

    function indiaPostShipped() {
        $data['orders'] = $this->others->getIndiaPostShipped();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/indiapostorders/shipped', $data);
        $this->load->view('admin/footer');
    }

    function indiaPostCancel() {
        $data['orders'] = $this->others->getIndiaPostCancel();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/indiapostorders/cancel', $data);
        $this->load->view('admin/footer');
    }

    function indiaPostShippedCancel() {
        $data['orders'] = $this->others->getIndiaPostShippedCancel();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/indiapostorders/shippedcancel', $data);
        $this->load->view('admin/footer');
    }

    function indiaPostDelivered() {
        $data['orders'] = $this->others->getIndiaPostDelivered();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/indiapostorders/delivered', $data);
        $this->load->view('admin/footer');
    }

    function indiaPostReturn() {
        $data['orders'] = $this->others->getIndiaPostReturn();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/indiapostorders/return', $data);
        $this->load->view('admin/footer');
    }

    function indiaPostRefund() {
        $data['orders'] = $this->others->getIndiaPostRefund();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/indiapostorders/refund', $data);
        $this->load->view('admin/footer');
    }

    function indiaPostCod() {
        $data['orders'] = $this->others->getIndiaPostCod();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/indiapostorders/cod', $data);
        $this->load->view('admin/footer');
    }

    function indiaPostCard() {
        $data['orders'] = $this->others->getIndiaPostCard();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/indiapostorders/card', $data);
        $this->load->view('admin/footer');
    }
    
    // Dtdc Orders Functions
    
    function allDtdc() {
        $data['orders'] = $this->others->getAllDtdc();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/dtdcorders/all', $data);
        $this->load->view('admin/footer');
    }

    function dtdcShipped() {
        $data['orders'] = $this->others->getDtdcShipped();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/dtdcorders/shipped', $data);
        $this->load->view('admin/footer');
    }

    function dtdcCancel() {
        $data['orders'] = $this->others->getDtdcCancel();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/dtdcorders/cancel', $data);
        $this->load->view('admin/footer');
    }

    function dtdcShippedCancel() {
        $data['orders'] = $this->others->getDtdcShippedCancel();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/dtdcorders/shippedcancel', $data);
        $this->load->view('admin/footer');
    }

    function dtdcDelivered() {
        $data['orders'] = $this->others->getDtdcDelivered();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/dtdcorders/delivered', $data);
        $this->load->view('admin/footer');
    }

    function dtdcReturn() {
        $data['orders'] = $this->others->getDtdcReturn();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/dtdcorders/return', $data);
        $this->load->view('admin/footer');
    }

    function dtdcRefund() {
        $data['orders'] = $this->others->getDtdcRefund();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/dtdcorders/refund', $data);
        $this->load->view('admin/footer');
    }

    function dtdcCod() {
        $data['orders'] = $this->others->getDtdcCod();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/dtdcorders/cod', $data);
        $this->load->view('admin/footer');
    }

    function dtdcCard() {
        $data['orders'] = $this->others->getDtdcCard();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/dtdcorders/card', $data);
        $this->load->view('admin/footer');
    }

    //-------------------------- Pay U Money Orders ----------------------------

    function payumoneyOrders() {
        $data['orders'] = $this->others->getpayumoneyOrders();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/payumoney/orders', $data);
        $this->load->view('admin/footer');
    }

    //------------------------------Payment Received ---------------------------

    function fedexReceivePayment() {
        $payment_by = 1;           // 1 = Payment Received From Fedex 
        $result = $this->others->receivePayment($payment_by);
        if ($result) {
            header('location:' . site_url() . 'admin/others/allFedex?msg=S');
        } else {
            header('location:' . site_url() . 'admin/others/allFedex?msg=F');
        }
    }

    function indiapostReceivePayment() {
        $payment_by = 2;           // 2 = Payment Received From India Post 
        $result = $this->others->receivePayment($payment_by);
        if ($result) {
            header('location:' . site_url() . 'admin/others/allIndiapost?msg=S');
        } else {
            header('location:' . site_url() . 'admin/others/allIndiapost?msg=F');
        }
    }
    
    function dtdcReceivePayment() {
        $payment_by = 4;           // 4 = Payment Received From DTDC 
        $result = $this->others->receivePayment($payment_by);
        if ($result) {
            header('location:' . site_url() . 'admin/others/allDtdc?msg=S');
        } else {
            header('location:' . site_url() . 'admin/others/allDtdc?msg=F');
        }
    }

    function payumoneyReceivePayment() {
        $payment_by = 3;           // 3 = Payment Received From Pay U Money 
        $result = $this->others->receivePayment($payment_by);
        if ($result) {
            header('location:' . site_url() . 'admin/others/payumoneyOrders?msg=S');
        } else {
            header('location:' . site_url() . 'admin/others/payumoneyOrders?msg=F');
        }
    }

    //-------------------------------- Pay Expense ---------------------------------

    function fedexPayExpense() {
        $payment_by = 1;           // 1 = Pay Expense To Fedex 
        $result = $this->others->payExpense($payment_by);
        if ($result) {
            header('location:' . site_url() . 'admin/others/allFedex?msg=ES');
        } else {
            header('location:' . site_url() . 'admin/others/allFedex?msg=EF');
        }
    }

    function indiapostPayExpense() {
        $payment_by = 2;           // 2 = Pay Expense To India Post 
        $result = $this->others->payExpense($payment_by);
        if ($result) {
            header('location:' . site_url() . 'admin/others/allIndiapost?msg=ES');
        } else {
            header('location:' . site_url() . 'admin/others/allIndiapost?msg=EF');
        }
    }
    
    function dtdcPayExpense() {
        $payment_by = 3;           // 3 = Pay Expense To DTDC 
        $result = $this->others->payExpense($payment_by);
        if ($result) {
            header('location:' . site_url() . 'admin/others/allDtdc?msg=ES');
        } else {
            header('location:' . site_url() . 'admin/others/allDtdc?msg=EF');
        }
    }

    //-----------------------------Payment Record Master -----------------------------

    function fedexPayments() {
        $data['payments'] = $this->others->fedexPayments();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/receivepayment/fedex', $data);
        $this->load->view('admin/footer');
    }

    function fedexPaymentDelete() {
        $id = base64_decode($this->input->get('id'));
        $this->others->fedexPaymentDelete($id);
        header('location:' . site_url() . 'admin/others/fedexPayments');
    }

    function indiapostPayments() {
        $data['payments'] = $this->others->indiapostPayments();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/receivepayment/indiapost', $data);
        $this->load->view('admin/footer');
    }

    function indiapostPaymentDelete() {
        $id = base64_decode($this->input->get('id'));
        $this->others->indiapostPaymentDelete($id);
        header('location:' . site_url() . 'admin/others/indiapostPayments');
    }
    
    function dtdcPayments() {
        $data['payments'] = $this->others->dtdcPayments();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/receivepayment/dtdc', $data);
        $this->load->view('admin/footer');
    }

    function dtdcPaymentDelete() {
        $id = base64_decode($this->input->get('id'));
        $this->others->dtdcPaymentDelete($id);
        header('location:' . site_url() . 'admin/others/dtdcPayments');
    }

    function payumoneyPayments() {
        $data['payments'] = $this->others->payumoneyPayments();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/receivepayment/payumoney', $data);
        $this->load->view('admin/footer');
    }

    function payumoneyPaymentDelete() {
        $id = base64_decode($this->input->get('id'));
        $this->others->payumoneyPaymentDelete($id);
        header('location:' . site_url() . 'admin/others/payumoneyPayments');
    }

    function paymentOrdersView() {
        $id = base64_decode($this->input->get('id'));
        $data['orders'] = $this->others->paymentOrdersView($id);
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/receivepayment/orderslist', $data);
        $this->load->view('admin/footer');
    }

    //-----------------------------Expense Record Master -----------------------------

    function fedexExpenses() {
        $data['expenses'] = $this->others->fedexExpenses();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/expensepayment/fedex', $data);
        $this->load->view('admin/footer');
    }

    function fedexExpensesDelete() {
        $id = base64_decode($this->input->get('id'));
        $this->others->fedexExpenseDelete($id);
        header('location:' . site_url() . 'admin/others/fedexExpenses');
    }

    function indiapostExpenses() {
        $data['expenses'] = $this->others->indiapostExpenses();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/expensepayment/indiapost', $data);
        $this->load->view('admin/footer');
    }

    function indiapostExpensesDelete() {
        $id = base64_decode($this->input->get('id'));
        $this->others->indiapostExpenseDelete($id);
        header('location:' . site_url() . 'admin/others/indiapostExpenses');
    }
    
    function dtdcExpenses() {
        $data['expenses'] = $this->others->dtdcExpenses();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/expensepayment/dtdc', $data);
        $this->load->view('admin/footer');
    }

    function dtdcExpensesDelete() {
        $id = base64_decode($this->input->get('id'));
        $this->others->dtdcExpenseDelete($id);
        header('location:' . site_url() . 'admin/others/dtdcExpenses');
    }

    function expensesOrdersView() {
        $id = base64_decode($this->input->get('id'));
        $data['orders'] = $this->others->expensesOrdersView($id);
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/expensepayment/orderslist', $data);
        $this->load->view('admin/footer');
    }

    //---------------------------------CA Report--------------------------------------

    function CAReport() {
        $data['orders'] = $this->others->getCAReport();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/ca/ca', $data);
        $this->load->view('admin/footer');
    }

    function caReportSearch() {
        $data['orders'] = $this->others->getCAReportSearch();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/ca/ca', $data);
        $this->load->view('admin/footer');
    }

    function caReportPrint() {
        $data['orders'] = $this->others->getCAReportSearch();
        $this->load->view('admin/other_pages/ca/print', $data);
    }

    //---------------------------Seller Balance Master---------------------------------

    function sellerBalance() {
        $data['sellers'] = $this->others->getAllSellers();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/sellerbalance/sellerbalance', $data);
        $this->load->view('admin/footer');
    }

    function sellerBalanceSearch() {
        $data['sellers'] = $this->others->sellerSearch();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/sellerbalance/sellerbalance', $data);
        $this->load->view('admin/footer');
    }

    // ------------------------- Admin Expense ---------------------------------------

    function expense() {
        $data['expense'] = $this->others->getAllExpenseData();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/expense/expense_mst', $data);
        $this->load->view('admin/footer');
    }

    function searchExpense() {
        $data['expense'] = $this->others->getSearchExpenseData();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/expense/expense_mst', $data);
        $this->load->view('admin/footer');
    }

    function addExpense() {
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/expense/add_expense');
        $this->load->view('admin/footer');
    }

    function addExpenseData() {
        if (isset($_POST['expense_id'])) {
            if ($_POST['expense_id'] == "") {
                $this->others->addExpenseData();
                header('location:' . site_url() . 'admin/others/expense');
            } else {
                $this->others->updateExpenseData();
                header('location:' . site_url() . 'admin/others/expense');
            }
        }
    }

    function getExpenseData() {
        $data['expense'] = $this->others->getExpenseData();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/expense/add_expense', $data);
        $this->load->view('admin/footer');
    }

    function viewExpenseData() {
        $data['expense'] = $this->others->getExpenseData();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/expense/view_expense', $data);
        $this->load->view('admin/footer');
    }

    function deleteExpenseData() {
        $this->others->deleteExpenseData();
        header('location:' . site_url() . 'admin/others/expense');
    }

    //-------------------------Bulk Sms Master -------------------------------------

    function bulkSms() {
        $data['contact'] = $this->others->getBulkSmsContact();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/bulksms/bulksms', $data);
        $this->load->view('admin/footer');
    }

    function smsContactImport() {
        $this->others->smsContactImport();
    }

    function sendBulkSms() {
        $data['position'] = $this->others->getPosition();
        $data['group'] = $this->others->getGroup();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/bulksms/sendbulksms', $data);
        $this->load->view('admin/footer');
    }

    function sendSms() {
        $to = $this->others->getContactMobile();
        $message = $_POST['message'];
        $this->common->SMSSend($to, $message, true);
        header('location:' . site_url() . 'admin/others/sendBulkSms?msg=S');
    }

    function contactfileDownload() {
        $data = file_get_contents(FCPATH . "/upload/productfile/bulksms.csv"); // Read the file's contents
        $name = 'bulksms.csv';
        force_download($name, $data);
    }

    // ------------------------- Order Profit Loss ---------------------------------------

    function revenue() {
        $data['revenue'] = $this->others->getAllRevenueData();
        $data['totalexpense'] = $this->others->totalExpense();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/revenue/revenue_mst', $data);
        $this->load->view('admin/footer');
    }

    function searchRevenue() {
        $data['revenue'] = $this->others->getSearchRevenueData();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/revenue/revenue_mst', $data);
        $this->load->view('admin/footer');
    }

    function addRevenue() {
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/revenue/add_revenue');
        $this->load->view('admin/footer');
    }

    function addRevenueData() {
        if (isset($_POST['revenue_id'])) {
            if ($_POST['revenue_id'] == "") {
                $msg = $this->others->addRevenueData();
                header('location:' . site_url() . 'admin/others/revenue?msg=' . $msg);
            } else {
                $this->others->updateRevenueData();
                header('location:' . site_url() . 'admin/others/revenue');
            }
        }
    }

    function getRevenueData() {
        $data['revenue'] = $this->others->getRevenueData();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/revenue/add_revenue', $data);
        $this->load->view('admin/footer');
    }

    function deleteRevenueData() {
        $this->others->deleteRevenueData();
        header('location:' . site_url() . 'admin/others/revenue');
    }
    
    // ------------------------- Courier Profit Loss ---------------------------------------

    function courier() {
        $data['courier'] = $this->others->getAllCourierData();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/courier/courier_mst',$data);
        $this->load->view('admin/footer');
    }

    function searchCourier() {
        $data['courier'] = $this->others->getSearchCourierData();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/courier/courier_mst', $data);
        $this->load->view('admin/footer');
    }

    function addCourier() {
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/courier/add_courier');
        $this->load->view('admin/footer');
    }

    function addCourierData() {
        if (isset($_POST['id'])) {
            if ($_POST['id'] == "") {
                $msg = $this->others->addCourierData();
                header('location:' . site_url() . 'admin/others/courier?msg=' . $msg);
            } else {
                $this->others->updateCourierData();
                header('location:' . site_url() . 'admin/others/courier');
            }
        }
    }

    function getCourierData() {
        $data['courier'] = $this->others->getCourierData();
        $this->load->view('admin/header');
        $this->load->view('admin/other_pages/courier/add_courier', $data);
        $this->load->view('admin/footer');
    }

    function deleteCourierData() {
        $this->others->deleteCourierData();
        header('location:' . site_url() . 'admin/others/courier');
    }

}
