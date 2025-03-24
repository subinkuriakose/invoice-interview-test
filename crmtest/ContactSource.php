<?php
interface ContactSource {
    public function createContact(array $data): Contact;
}
