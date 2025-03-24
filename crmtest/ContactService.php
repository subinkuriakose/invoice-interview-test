<?php
class ContactService {
    private $source;

    public function __construct(ContactSource $source) {
        $this->source = $source;
    }

    public function createContact(array $data): Contact {
        return $this->source->createContact($data);
    }
}
