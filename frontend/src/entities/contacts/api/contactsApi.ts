import { ContactsResponse } from "./types";

export const fetchContacts = async (): Promise<ContactsResponse> => {
  const response = await fetch("/api/contacts");
  return response.json();
};
