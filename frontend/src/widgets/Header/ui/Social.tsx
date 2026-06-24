import Image from "next/image";
import styles from "./Header.module.css";

export const Social = () => {
  return (
    <>
      <div className={styles.social}>
        <Image alt="tg-logo" src="/tg-logo.svg" width={32} height={32} />
        <Image alt="max-logo" src="/max-logo.svg" width={32} height={32} />
        <Image alt="vk-logo" src="/vk-logo.svg" width={32} height={32} />
      </div>
    </>
  );
};
