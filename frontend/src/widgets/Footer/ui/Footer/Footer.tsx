"use client";
import { useContacts } from "@/entities/contacts/api/contactsApi";
import { Contacts } from "../Contacts";
import { Logo } from "../Logo";
import { Nav } from "../Nav";
import styles from "./Footer.module.scss";
import { Container } from "@/shared/ui/Container";

export const Footer = () => {
  const { data, isError } = useContacts();

  const allContacts = data?.data || [];

  const filteredContacts = allContacts.filter((contact) => {
    return contact.kay === "phone" || contact.kay === "email" || contact.kay === "address";
  });

  return (
    <Container>
      <section className={styles.footer}>
        <div className={styles.footerTop}>
          <Logo />
          <Nav />
          {isError ? (
            <div>Ошибка загрузки контактов</div>
          ) : (
            <Contacts contacts={filteredContacts} />
          )}
        </div>
        <div className={styles.footerBottom}>
          <div className={styles.left}>
            <p>
              © 2026 ООО «Киберия», номер в реестре <br /> аккредитованных IT-компаний: 53278
            </p>
          </div>
          <div className={styles.middle}>Реквизиты компании</div>
          <div className={styles.right}>Политика конфиденциальности</div>
        </div>
      </section>
    </Container>
  );
};
