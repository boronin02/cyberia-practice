import styles from "./Burger.module.scss";
import Link from "next/link";
import Image from "next/image";
import { burger } from "@/shared/assets/images/header";
import { TgIcon } from "@/shared/assets/icons";

interface BurgerProps {
  toggleMenu: () => void;
}

export const Burger = ({ toggleMenu }: BurgerProps) => {
  return (
    <div className={styles.burger}>
      <Link href="/" className={styles.burger}>
        <TgIcon />
      </Link>
      <Image src={burger} alt="burger" width={24} onClick={toggleMenu} />
    </div>
  );
};
